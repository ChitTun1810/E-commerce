<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Orderitems;
use App\Models\Product;
use Livewire\Component;

class AdminViewOrderComponent extends Component
{
    public function cancleOrder($id)
    {        
        $item = Orderitems::all()->where('order_id',$id);
        foreach($item as $data)
        {
            $product = Product::where('id',$data->product_id)->first();
            $product->quantity = ($product->quantity) + ($data->quantity);
            $product->save();
            $data->delete();

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
        return view('livewire.admin.admin-view-order-component',[
            'orders' => $orders ,
            'orderitems' => $orderitems,
        ]);
    }
}
