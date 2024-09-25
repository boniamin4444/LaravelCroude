<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\basicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductShowController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return redirect('/products');
})->name('login');

Route::get('register', function () {
    return redirect('/products');
})->name('register');

Route::get('/',[ProductShowController::class,'show'])->name('welcome.show');

//POST routes (handling form submission)

Route::post('login',[AuthController::class,'login'])->name('login.post');
Route::post('register',[AuthController::class,'register'])->name('register.post');
Route::post('logout',[AuthController::class,'logout'])->name('logout');

//Email Verify Route

Route::get('email/verify/{id}/{hash}', [AuthController::class,'verifyEmail'])->name('verification.verify');

Route::middleware(['custom.auth'])->group(function(){

	Route::resource('products', ProductController::class);

	Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');

	Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update');
});










