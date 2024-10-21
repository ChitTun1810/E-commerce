<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;

class CouponComponent extends Component
{
    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return back()->with('message','Delete successfully');
    }
    
    public function render()
    {
        $coupons = Coupon::all();
        Coupon::where('quantities','<',1)->delete();
        return view('livewire.coupon-component',[
            'coupons' => $coupons,
        ]);
    }
}
