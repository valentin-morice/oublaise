<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $attributes = $request->validate([
            'amount' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'project' => 'required|numeric',
        ]);


        return Inertia::render('StripeCreate', [
            'donation' => [
                'first_name' => ucwords(strtolower($request->input(['first_name']))),
                'last_name' => ucwords(strtolower($request->input(['last_name']))),
                'amount' => $request->input(['amount']),
                'email' => $request->input(['email']),
                'project' => $attributes['project'],
                'stripePK' => getenv('STRIPE_PUBLISHABLE_KEY'),
            ]
        ]);
    }
}
