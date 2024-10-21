<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Productreview;
use App\Models\Review;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $rate;
    public $slug;
    public $stars;
    public $content;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        $this->emitTo('cart-icon-component','refreshComponent');
        return redirect()->route('shop.cart');
    }
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
    public function makereview($id)
    {
        $review = new Productreview;
        $review->product_id = $id;
        $review->user_id = auth()->user()->id;
        $review->content = $this->content;
        $review->rating = $this->stars;
        $review->save();
        return back()->with('info','Created review successfully!!');
    }

    public function render()
    {
        $productreviews = Productreview::paginate();
        $product = Product::where('slug',$this->slug)->first();
        return view('livewire.details-component',[
            'product' => $product,
            'productreviews' => $productreviews,
        ]);
    }
}
