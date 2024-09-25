<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\basicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductShowController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\Auth\PasswordResetController;

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

// Password reset link request
Route::get('password/reset', [PasswordResetController::class, 'request'])->name('password.request');
// Password reset link submission
Route::post('password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
// Password reset form
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
// Password reset submission
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

Route::get('/',[ProductShowController::class,'show'])->name('welcome.show');


Route::post('login',[AuthController::class,'login'])->name('login.post');
Route::post('register',[AuthController::class,'register'])->name('register.post');
Route::post('logout',[AuthController::class,'logout'])->name('logout');

//Email Verify Route

Route::resource('categories', CategoryController::class);


Route::get('email/verify/{id}/{hash}', [AuthController::class,'verifyEmail'])->name('verification.verify');

Route::middleware(['custom.auth'])->group(function(){

	Route::resource('products', ProductController::class);

	Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');

	Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update');
});










