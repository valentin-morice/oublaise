<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Temp;
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

        $customer = $this->stripe->customers->retrieve($currentPayment->customer);

        return Inertia::render('StripeSuccess', [
            'data' => [
                'customer' => $customer->name,
                'amount' => $currentPayment->amount,
                'paymentId' => $currentPayment->id,
                'status' => $currentPayment->status,
            ],
        ]);
    }

    public function create()
    {
        Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            $customer = Customer::create([
                'name' => $jsonObj->{'first_name'} . ' ' . $jsonObj->{'last_name'},
                'email' => $jsonObj->{'email'},
            ]);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => $jsonObj->{'amount'} * 100,
                'customer' => $customer->id,
                'setup_future_usage' => 'off_session',
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            Temp::create([
                'payment_id' => $paymentIntent->id,
                'project_id' => $jsonObj->{'project'}
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
