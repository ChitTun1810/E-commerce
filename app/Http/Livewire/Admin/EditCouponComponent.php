<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class EditCouponComponent extends Component
{
    public $code;
    public $newcode;
    public function mount($code)
    {
        $this->code = $code;
    }
    public function update($id)
    {
        $coupon = Coupon::find($id)->where('code',$this->code)->first();
        $coupon->code = $this->newcode;
        $coupon->update();

        return redirect(route('coupon'))->with('message','Coupon Update Successfully');
    }
    public function render()
    {
        $coupon = Coupon::where('code',$this->code)->first();
        return view('livewire.admin.edit-coupon-component',[
            'coupon' => $coupon,
        ]);
    }
}
