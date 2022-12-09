<?php

namespace App\Jobs;

use App\Models\Custom\Customer;
use App\Models\Payment;
use App\Models\Temp;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob as SpatieProcessWebhookJob;

class ProcessWebhookJob extends SpatieProcessWebhookJob
{
    public function handle()
    {
        $this->process_payment_intent();

        return response('', 200);
    }

    private function process_payment_intent()
    {
        $client = new \Stripe\StripeClient(getenv('STRIPE_SECRET_KEY'));

        $customer = $client->customers->retrieve($this->webhookCall->payload['data']['object']['customer'], []);

        $payment = Payment::where('stripe_id', $this->webhookCall->payload['data']['object']['id'])->exists();

        if ($payment) {
            if (Payment::where('stripe_id', $this->webhookCall->payload['data']['object']['id'])->first()->status !== "succeeded")
                Payment::where('stripe_id', $this->webhookCall->payload['data']['object']['id'])->first()->update([
                    'status' => $this->webhookCall->payload['data']['object']['status']
                ]);
            return;
        }

        $new_customer = Customer::create([
            'name' => $customer->name,
            'email' => $customer->email,
        ]);

        Payment::create([
            'amount' => $this->webhookCall->payload['data']['object']['amount'] / 100,
            'stripe_id' => $this->webhookCall->payload['data']['object']['id'],
            'project_id' => Temp::firstWhere('payment_id', $this->webhookCall->payload['data']['object']['id'])->project_id,
            'customer_id' => $new_customer->id,
            'status' => $this->webhookCall->payload['data']['object']['status']
        ]);

        Temp::where('payment_id', $this->webhookCall->payload['data']['object']['id'])->delete();
    }

}
