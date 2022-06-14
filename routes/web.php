<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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

// Routes produits
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/produit/search', [ProductController::class, 'search'])->name('products.search');


// Route Cart
Route::group(['middleware' => ['auth']], function(){
    Route::get('/panier/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/panier/ajouter', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/panier/supprimer/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/panier/{rowId}', [CartController::class, 'update'])->name('cart.update');

    Route::post('/cart/coupon', [CartController::class, 'storeCoupon'])->name('cart.store.coupon');
    Route::delete('/cart/coupon', [CartController::class, 'destroyCoupon'])->name('cart.destroy.coupon');
});


/* Checkout Routes */
Route::group(['middleware' => ['auth']], function(){
    Route::get('/panier/paiment', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/panier/paiment', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/panier/merci', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');
});


// Auth::routes();
// Login Routes...
Route::get('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Logout Routes...
Route::post('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('/user/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/user/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/user/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Password Reset Routes...
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Password Confirmation Routes...
Route::get('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);

// Email Verification Routes...
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
