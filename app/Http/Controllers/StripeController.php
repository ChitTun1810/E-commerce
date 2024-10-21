<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function session()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => 'Paid For Your Order',
                        ],
                        'unit_amount'  => Cart::total(),
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('home'),
            'cancel_url'  => route('shop.cart'),
        ]);

        return redirect()->away($session->url);
    }
    public function check()
    {
        dd('success');
    }
}


