<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutComponent extends Component
{
    
    public  $firstname;
    public  $lastname;
    public  $companyname;
    public  $country;
    public  $address;
    public  $address_line2;
    public  $city;
    public  $stage;
    public  $zip;
    public  $phone;
    public  $email;
    
    public $ship_to_different;
    public  $s_firstname;
    public  $s_lastname;
    public  $s_companyname;
    public  $s_country;
    public  $s_address;
    public  $s_address_line2;
    public  $s_city;
    public  $s_stage;
    public  $s_zip;
    public  $s_email;

    public function updated($fields)
    {
        $this->validateonly($fields,[
            'firstname' =>  'required',
            'lastname'  =>  'required',
            'companyname'   =>  'required',
            'country'   =>  'required',
            'address'   =>  'required',
            'city'  =>  'required',
            'stage' =>  'required',
            'zip'   =>  'required',
            'phone' =>  'required',
            'email' =>  'required',
        ]);
    }
    public function placeOrder()
    {
        $this->validate([
            'firstname' =>  'required',
            'lastname'  =>  'required',
            'companyname'   =>  'required',
            'country'   =>  'required',
            'address'   =>  'required',
            'city'  =>  'required',
            'stage' =>  'required',
            'zip'   =>  'required',
            'phone' =>  'required',
            'email' =>  'required',
        ]);
    }
    public function render()
    {
        return view('livewire.checkout-component');
    }
}
