<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\basicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\frontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Models\Product;

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

Route::get('/', [frontController::class, "index"]);

Route::get('login', function () {
    return redirect('/products');
})->name('login');

Route::get('register', function () {
    return redirect('/products');
})->name('register');

//POST routes (handling form submission)

Route::post('login',[AuthController::class,'login'])->name('login.post');
Route::post('register',[AuthController::class,'register'])->name('register.post');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

//Email Verify Route

Route::get('email/verify/{id}/{hash}', [AuthController::class,'verifyEmail'])->name('verification.verify');

//Fetching filtered products routes according t6o categories and prices
Route::get('/products', [frontController::class, 'index'])->name('products.index');

Route::post('/products/filter', [frontController::class, 'filterProducts'])->name('products.filter');



Route::middleware(['custom.auth'])->group(function(){

	

	//Cart Routes

	Route::get('/cart',[CartController::class, 'viewCart'])->name('cart.view');

	Route::post('/cart/add',[CartController::class,'addToCart'])->name('cart.add');

	Route::delete('/cart/remove',[CartController::class, 'removeFromCart'])->name('cart.remove');

	Route::post('/cart/clear',[CartController::class, 'clearCart'])->name('cart.clear');
});

//Admin Routes

	Route::get('admin',[AdminController::class, 'index']);
	Route::post('admin/auth',[AdminController::class, 'auth'])->name('admin.auth');
	
	//Route::get('/admin/updatepass',[AdminController::class, 'updatePassword']);

	Route::group(['middleware'=>'admin_auth'], function(){

		Route::get('admin/dashboard',[AdminController::class, 'dashboard']);
		Route::get('admin/category',[CategoryController::class, 'index']);
		Route::get('admin/category/manage_category',[CategoryController::class, 'manage_category']);
		Route::get('admin/category/manage_category/{id}',[CategoryController::class, 'manage_category']);

		Route::post('admin/category/manage_category_process',[CategoryController::class, 'manage_category_process'])->name('category.manage_category_process');

		Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);

		//coupon

		Route::get('admin/coupon',[CouponController::class, 'index']);
        Route::get('admin/coupon/manage_coupon',[CouponController::class, 
       'manage_coupon']);
        Route::get('admin/coupon/manage_coupon/{id}',[CouponController::class, 
        'manage_coupon']);
         Route::post('admin/coupon/manage_coupon_process',[CouponController::class, 
          'manage_coupon_process'])->name('coupon.manage_coupon_process');
        Route::get('admin/coupon/delete/{id}', [CouponController::class, 'delete']);

	//Product Routes
	Route::resource('products', ProductController::class);

	Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');

	Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update');	
	});

	//product notifications

	Route::get('noptifications/mark-as-read', function(){
		auth()->user()->unreadNotifications->markAsRead();
		return redirect()->back();
	})->name('notifications.markAsRead');

	Route::get('/product-details/{id}', function($id){
		$product = Product::findOrFail($id);

		auth()->user()->unreadNotifications->where('data.product_id', $id)->markAsRead();

		return view('products.product_details', compact('product'));
	})->name('product.details');;

    Route::get('admin/logout', function() {
		session()->forget('ADMIN_LOGIN');
		session()->forget('ADMIN_ID');
		session()->flash('error', 'Logout Successfully');
		return redirect('admin');
	});








