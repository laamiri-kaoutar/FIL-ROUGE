<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Charge;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function charge($amount, $token)
    {
        try {
            $charge = Charge::create([
                'amount' => $amount * 100, // Stripe expects amount in cents
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Payment for FreelanceHub order',
            ]);
            return $charge;
        } catch (\Exception $e) {
            throw new \Exception('Payment failed: ' . $e->getMessage());
        }
    }
}