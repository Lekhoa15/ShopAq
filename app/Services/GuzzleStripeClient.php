<?php
namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class GuzzleStripeClient
{
    public function createCheckoutSession($lineItems, $successUrl, $cancelUrl)
    {
        Stripe::setApiKey(env('STRIPE_SECRET')); // Đảm bảo API key được thiết lập ngay trước khi gọi Stripe API

        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
        ]);
    }
}
