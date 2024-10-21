<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Default";

     

// ************************    
// ****    searching   ****
// ************************
    public $q;
        public $search_term;
        public function mount()
        {
            $this->fill(request()->only('q'));
            $this->search_term = '%'.$this->q . '%';
        }

    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        $this->emitTo('cart-icon-component','refreshComponent');
        return redirect()->route('shop.cart');
    }
    public function sorting($sort)
    {
        $this->orderBy = $sort;
    }
    public function changeSize($size)
    {   
        $this->pageSize = $size;
    }
    public function render()
    {
        if($this->orderBy == 'Price: Low To High')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Price: High To Low')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Hot')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else{
            $products = Product::where('name','like',$this->search_term)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get();
        return view('livewire.search-component',[
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
