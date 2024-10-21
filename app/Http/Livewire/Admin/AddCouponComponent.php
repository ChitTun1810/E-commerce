<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;

class AddCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $amount_limit;
    public $quantities;

    public function update($fields)
    {
        $this->validateOnly($fields,[
            'code' => 'required|unique:coupons',
            'type'  => 'required',
            'value' => 'required|numeric',
            'amount_limit'    => 'required|numeric',
            'quantities'   => 'required',
        ]);
    }

    public function addcoupon()
    {
        $this->validate([
            'code' => 'required|unique:coupons',
            'type'  => 'required',
            'value' => 'required|numeric',
            'amount_limit'    => 'required|numeric',
            'quantities'   => 'required',
        ]);
        $coupon = new Coupon;
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->amount_limit = $this->amount_limit;
        $coupon->quantities =$this->quantities;
        $coupon->save();

        session()->flash('message','Coupon has been created successfully');
        return redirect(route('coupon'));
    }

    public function render()
    {
        return view('livewire.admin.add-coupon-component');
    }
}
