<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Coupon;
use Stripe\Stripe;

class CartComponent extends Component
{
    public $haspromo;
    public $coupon;
    public $discount;
    public $subtotalDis;
    public $taxDis;
    public $totalDis;
    public $distance;

    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty +1 ;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty -1 ;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');

    }
    public function deleteCart($id)
    {
        Cart::instance('cart')->remove($id);
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message','Item has been removed!');
    }
    public function clearAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component','refreshComponent');
    }
    public function payment()
    {
        // $cart = Cart::instance('cart')->total();
        // $result = str_replace(',', '', $cart);
        // $int = (float)$result;

        Stripe::setApiKey(config('stripe.sk'));
        $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));

        $session = $stripe->checkout->sessions->create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => 'Paid For Your Order',
                        ],
                        'unit_amount'  => (session()->get('checkout')['total'])*100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => 'https://127.0.0.1:8000/order',
            'cancel_url'  => 'https://127.0.0.1:8000/cart', 
        ]);
        return redirect()->away($session->url);
    }

    public function checksession()
    {
        $sessionData = session()->all();
        dd($sessionData);
    }
    public function applyCoupon()
    {
        $cpcode = Coupon::where('code',$this->coupon)->where('quantities','>',0)->where('amount_limit','<=',session('checkout')['subtotal'])->first();
        if(!$cpcode)
        {
            session()->flash('coupon_message','Something Wrong check detail!!');
            return;
        }
        
        session()->put('coupon',[
            'id'    => $cpcode->id,
            'code' => $cpcode->code,
            'type' => $cpcode->type,
            'value' => $cpcode->value,
            'quantities' => $cpcode->quantities,
            'amount_limit' => $cpcode->amount_limit,
        ]);
    }

    // Calculation if use coupon
    public function calDiscount()
    {
        // for shipping cost 
        $this->calDelivery();
        // 1km = 5$ cost
        $deliveryCost = round($this->distance * 5);

        if(session()->has('coupon'))
        {
            if(session()->get('coupon')['type']=='fixed')
            {
                $this->discount =session()->get('coupon')['value'];
            }else{
                $this->discount = (Cart::instance('cart')->subtotal()* session()->get('coupon')['value'])/100;
            }
            $this->subtotalDis = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxDis = ($this->subtotalDis * config('cart.tax'))/100;
            $this->totalDis = $this->subtotalDis + $this->taxDis + $deliveryCost;
        }
    }
    public function convertStringToFloat($string) 
    {
        $cleanedString = str_replace(',', '', $string);
        $floatValue = floatval($cleanedString);
        return $floatValue;
    }

    // End Calculation

    // ************************************************************************************
    // ******* condition use coupon or not use coupon  ************************************
    // ************************************************************************************
    public function setAmountForCheckout()
    {
        // for shipping cost
        $this->calDelivery();
        // 1km = 5$ cost
        $deliveryCost = round($this->distance * 5);

        if(session()->has('coupon'))
        {
            session()->put('checkout',[
                'discount' => $this->discount,
                'subtotal'  => $this->subtotalDis,
                'tax'   => round($this->taxDis),
                'total' => round($this->totalDis),
                'coupon'  => $this->coupon,
            ]);
        }
        else{
            session()->put('checkout',[
                'discount' => 0,
                'subtotal'  => $this->convertStringToFloat(Cart::instance('cart')->subtotal()),
                'tax'   => $this->convertStringToFloat(Cart::instance('cart')->tax()),
                'total' => round($this->convertStringToFloat(Cart::instance('cart')->total())+ $deliveryCost),
                'coupon'  => $this->coupon,
            ]);
        }
    }

    // End condition

    // for calculate distance between customer and shop 
    public function calDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6563)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        $this->distance = ($angle * $earthRadius);
        return $this->distance;
    }
    // for calculate Delivery cost
    public function calDelivery()
    {
        $this->calDistance(16.774292,96.161581,auth()->user()->lat,auth()->user()->lang);

    }

    public function render()
    {
        $this->calDelivery();
        $deliveryCost = round($this->distance * 5);
        // step by step
        if(session()->has('coupon'))
        {
            // Coupon will not work if amount is under the require

            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['amount_limit'])
            {
                session()->forget('coupon');

            // Otherwise Coupon will work
            
            }else{
                $this->calDiscount();
            }
        }
        $this->setAmountForCheckout();
        // end step by step 
        
        return view('livewire.cart-component',[
            'deliveryCost' => $deliveryCost,
        ]);
    }
}
