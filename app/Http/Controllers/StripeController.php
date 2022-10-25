<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeController extends Controller
{

    public ?StripeClient $stripe = null;

    public function __construct()
    {
        $this->stripe = new StripeClient(
            getenv('STRIPE_SECRET_KEY')
        );
    }

    /**
     * @throws ApiErrorException
     */
    public function index(Request $request)
    {
        $payments = Payment::all()->reverse();
        $data = [];
        foreach ($payments as $payment) {
            $customer = $payment->customer;
            $transaction = [
                'name' => $customer->name ? $customer->name : 'Unnamed Customer',
                'amount' => $payment->amount,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('d/m/Y'),
                'email' => $customer->email,
                'customer_id' => $customer->id,
            ];
            $data[] = $transaction;
        }

        $filteredData = [];

        foreach ($data as $item) {
            if (str_contains(strtolower($item['name']), strtolower($request->query('search')))) {
                $filteredData[] = $item;
            }
        }

        return Inertia::render('StripeIndex', [
            'data' => $this->paginate($filteredData)->withQueryString(),
            'searchQuery' => $request->query('search'),
        ]);
    }

    protected function paginate($items, $perPage = 7, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), 7, $page, $options);
    }

    public function success(Request $request)
    {

        $currentPayment = $this->stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );

        $duplicate = Payment::where('stripe_id', $request->query('payment_intent'))->first();

        if ($duplicate) {
            return redirect('/');
        }

        if (!\App\Models\Custom\Customer::where('email', $this->stripe->customers->retrieve($currentPayment->customer)->email)->first()) {
            $customer = \App\Models\Custom\Customer::create([
                'email' => $this->stripe->customers->retrieve($currentPayment->customer)->email,
                'name' => $this->stripe->customers->retrieve($currentPayment->customer)->name,
            ]);
        } else {
            $customer = \App\Models\Custom\Customer::where('email', $this->stripe->customers->retrieve($currentPayment->customer)->email)->first();
        }

        $payment = Payment::create([
            'amount' => $currentPayment->amount / 100,
            'stripe_id' => $request->query('payment_intent'),
            'customer_id' => $customer->id,
        ]);


        return Inertia::render('StripeSuccess', [
            'data' => [
                'customer' => $customer->name,
                'amount' => $payment->amount,
                'paymentId' => $payment->stripe_id,
            ],
        ]);
    }

    public function create()
    {
        Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        function calculateOrderAmount($amount): int
        {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client
            return $amount * 100;
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Alternatively, set up a webhook to listen for the payment_intent.succeeded event
            // and attach the PaymentMethod to a new Customer
            $customer = Customer::create([
                'name' => $jsonObj->{'first_name'} . ' ' . $jsonObj->{'last_name'},
                'email' => $jsonObj->{'email'},
            ]);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => calculateOrderAmount($jsonObj->{'amount'}),
                'customer' => $customer->id,
                'setup_future_usage' => 'off_session',
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (ApiErrorException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $payments = \App\Models\Custom\Customer::find($id)->payments;
        $customer = \App\Models\Custom\Customer::find($id);
        $data = [];

        foreach ($payments as $payment) {
            $transaction = [
                'amount' => $payment->amount,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('d/m/Y'),
                'stripe_id' => $payment->stripe_id,
            ];
            $data[] = $transaction;
        }

        return Inertia::render('StripeShow', [
            'data' => $this->paginate($data)->withQueryString(),
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'customer_id' => $customer->id,
        ]);
    }
}
