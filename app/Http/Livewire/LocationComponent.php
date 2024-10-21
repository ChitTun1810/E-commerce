<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Traits\GeneralTrait;

class LocationComponent extends Component
{
    public function render()
    {
        $product = Product::where('id', 1)->first();
        dd($product->quantity - 1);
        return view('livewire.location-component');
    }
}
