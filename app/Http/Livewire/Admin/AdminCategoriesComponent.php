<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class AdminCategoriesComponent extends Component
{
    public $category_id;
    use WithPagination;

    public function deleteCategory()
    {
        $category = Category::find($this->category_id);
        $category->delete();
        session()->flash('message','Category has been deleted successfully');
    }
    public function render()
    {
        $categories = Category::orderBy('id','ASC')->paginate(12);
        return view('livewire.admin.admin-categories-component',[
            'categories' => $categories,
        ]);
    }
}
