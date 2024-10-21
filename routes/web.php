<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TestController;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\Admin\AddCouponComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthAdmin;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminViewOrderComponent;
use App\Http\Livewire\Admin\AdminViewUsersComponent;
use App\Http\Livewire\Admin\EditCouponComponent;
use App\Http\Livewire\BlogComponent;
use App\Http\Livewire\BlogDetailComponent;
use App\Http\Livewire\CouponComponent;
use App\Http\Livewire\FaqComponent;
use App\Http\Livewire\LocationComponent;
use App\Http\Livewire\NotificationComponent;
use App\Http\Livewire\OrderComponent;
use App\Http\Livewire\PaymentComponent;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Http\Livewire\User\ReviewComponent;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',HomeComponent::class)->name('home.index');

Route::get('/shop',ShopComponent::class)->name('shop');

Route::get('/product/{slug}',DetailsComponent::class)->name('product.detail');

Route::get('/about',AboutComponent::class)->name('about');

Route::get('/product.category/{slug}',CategoryComponent::class)->name('product.category');

Route::get('/search',SearchComponent::class)->name('product.search');

Route::get('location',LocationComponent::class)->name('location');

Route::get('/blog',BlogComponent::class)->name('blog');

Route::get('/blog/detail',BlogDetailComponent::class)->name('blog.detail');

Route::get('/p&p',PrivacyPolicyComponent::class)->name('p&p');

Route::get('/faq',[RouteController::class, 'test'])->name('faq');
Route::post('/faq/reply',[CommentController::class,'reply'])->name('reply');
Route::get('/editreply/{id}',[CommentController::class,'editreply']);
Route::get('/deletereply/{id}',[CommentController::class,'deletereply']);
Route::get('/deletereview/{id}',[CommentController::class,'deletereview']);
Route::get('/editreview/{id}',[CommentController::class,'editreview']);

// notification Test



Route::middleware(['auth','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories',AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add',AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('/admin/category/edit/{category_id}',AdminEditCategoryComponent::class)->name('admin.category.edit');
    Route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add',AdminAddProductComponent::class)->name('admin.product.add');
    route::get('/admin/coupon/add',AddCouponComponent::class)->name('admin.coupon.add');
    route::get('/admin/coupon/edit/{code}',EditCouponComponent::class)->name('admin.coupon.edit');
    route::get('/admin/view/order',AdminViewOrderComponent::class)->name('admin.view.order');
    route::get('/admin/view/users',AdminViewUsersComponent::class)->name('admin.view.users');

});

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wishlist',WishlistComponent::class)->name('shop.wishlist');
    Route::get('/cart',CartComponent::class)->name('shop.cart');
    Route::get('/trackorder',OrderComponent::class)->name('trackorder');
    Route::get('/coupon',CouponComponent::class)->name('coupon');
    Route::get('/user/review',ReviewComponent::class)->name('user.review');
    // read single noti
    Route::get('/readnoti/{id}',[NotificationComponent::class,'markasread']);
    // show old noti
    Route::get('/oldnoti',[NotificationComponent::class,'shownoti']);


    Route::post('/fileupload',[AdminDashboardComponent::class,'avatarUpload'])->name('avatarUpload');
    Route::group(['middleware' => 'checkout'], function () {
        Route::get('/cart/payment',PaymentComponent::class)->name('cart.payment');  
        Route::get('/cart/order',[OrderComponent::class,'order'])->name('cart.order');
    });


    // For database
    Route::get('/order',[OrderComponent::class,'order'])->name('order');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
