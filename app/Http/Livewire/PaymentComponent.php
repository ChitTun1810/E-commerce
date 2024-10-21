<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PaymentComponent extends Component
{
    public function checksession()
    {
        $sessionData = session()->all();
        dd($sessionData);
    }

    public function render()
    {
        return view('livewire.payment-component');
    }
}
