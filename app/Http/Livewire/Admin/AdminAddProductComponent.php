<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public  $short_description;
    public  $description;
    public $regular_price;
    public  $sale_price;
    public  $sku;
    public $stock_status = 'instock';
    public  $featured = 0;
    public  $quantity;
    public  $image;
    public $images;
    public  $category_id;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function addProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
              'short_description' => 'required',
              'description' => 'required',
             'regular_price' => 'required',
              'sale_price' => 'required',
              'sku' => 'required',
             'stock_status' => 'required',
              'featured' => 'required',
              'quantity' => 'required',
              'image'   => 'required',
              'images'   => 'required',
              'category_id' => 'required',
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        $imageName = $this->image->getClientOriginalName();
        $this->image->storeAs('products',$imageName);
        $product->image = $imageName;

        $imagesName = $this->images->getClientOriginalName();
        $this->images->storeAs('products',$imagesName);
        $product->images = $imagesName;

        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message','Product has been added');
        return redirect(route('admin.products'));
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component',[
            'categories' => $categories
        ]);
    }
}
