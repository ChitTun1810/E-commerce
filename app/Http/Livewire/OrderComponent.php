<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Orderitems;
use App\Models\Product;
use App\Notifications\OrderNotification;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class OrderCOmponent extends Component
{
    public function order()
    {
        $order = new Order;
        $order->user_name = auth()->user()->name;
        $order->email = auth()->user()->email;
        $order->phone = '0909090909';
        $order->lat = auth()->user()->lat;
        $order->lang = auth()->user()->lang;
        $order->subtotal =  session()->get('checkout')['subtotal'];

        if(session()->has('coupon')){
            $order->coupon_id = session()->get('coupon')['id'];
        }
        $order->discount = session()->get('checkout')['discount'];
        $order->total = session()->get('checkout')['total'];
        $order->save();
        
        foreach(Cart::instance('cart')->content() as $item)
        {
            $items = new Orderitems;
            $items->product_id = $item->id;
            $items->productname = $item->name;
            $items->order_id = $order->id;
            $items->price = $item->price;
            $items->quantity = $item->qty;
            $items->save();

        // for reduce product qty
            $product = Product::where('id',$item->id)->first();
            $product->quantity = ($product->quantity) - ($item->qty);
            $product->update();

        // product qty ka 0 phyit twar yin status ko change mal
            if($product->quantity < 1){
                $product->stock_status = 'outOfStock';
                $product->save();
            }
        }
        Cart::instance('cart')->destroy();

        // for reduce coupon amount
        if(session()->has('coupon'))
        {
            $coupon = Coupon::where('quantities',session()->get('coupon')['quantities'])->first();
            $coupon->quantities = (session()->get('coupon')['quantities']) - 1;
            $coupon->save();
        }
        $user = User::where('id',auth()->user()->id)->get();
        Notification::send($user, new OrderNotification($order));
            return redirect(route('trackorder'));
    }

    // *******************************************************************        
    // ************  for add (each) product qty after cancle order  ******
    // *******************************************************************
    public function cancleOrder($id)
    {        
        $item = Orderitems::all()->where('order_id',$id);
        foreach($item as $data)
        {
            $product = Product::where('id',$data->product_id)->first();
            $product->quantity = ($product->quantity) + ($data->quantity);
            $product->save();
            $data->delete();
            // for stock 
            if($product->quantity > 0)
            {
                $product->stock_status = 'instock';
                $product->save();
            }
        } 
        
        // for order
        $order = Order::find($id);
        $order->delete();

        // for coupon 
        // below code will not work if coupon_id is null inside the order table
        if(!empty($order->coupon_id)){
            $coupon = Coupon::where('id',$order->coupon_id)->first();
            $coupon->quantities = $coupon->quantities + 1;
            $coupon->save();
        }
        return back()->with('message','Order is deleted');
    }

    public function render()
    {
        $orders = Order::all();
        $orderitems = Orderitems::all();
        return view('livewire.order-component',[
            'orders' => $orders,
            'orderitems' => $orderitems,
        ]);
    }
}
