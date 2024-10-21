<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Reply;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeComponent extends Component
{
    use WithPagination;
    public function addToWishlist($product_id,$product_name,$product_price)
    {
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        $this->emitTo('wishlist-icon-component','refreshComponent');
    }
    public function removeWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if($witem->id==$product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component','refreshComponent');
                return;
            }
        }
    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        $this->emitTo('cart-icon-component','refreshComponent');
        return redirect()->route('shop.cart');
    }

    public function render()
    {
        $products = Product::paginate(8,['*'],'product');
        $cags = Product::all();
        return view('livewire.home-component',[
            'products' => $products,
            'cags'     => $cags,
        ]);
    }
}
