<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdresseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\DashboardController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Profile
Route::get('/profiles', [ProfileController::class, 'index']);
Route::put('/profiles/change_avatar', [ProfileController::class, 'changeAvatar']);

Route::get('profile', [UserController::class, 'edit'])->name('user.edit');
Route::prefix('profile')->group(function () {
    Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::patch('/password/change/{user}', [UserController::class, 'change'])->name('user.change');
});

Route::get('/my_orders', [OrderController::class, 'myOrders'])->name('my_orders');
Route::resource('orders', OrderController::class)->except(['destroy']);

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/shipping/edit', [ShippingController::class, 'edit'])->name('shipping.edit');
Route::patch('/shipping/update', [ShippingController::class, 'update'])->name('shipping.update');
Route::resource('shipping', ShippingController::class)->only(['index', 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/all_products', [ProductController::class, 'view'])->name('product.view');
Route::get('/product/{product}/{slug?}', [ProductController::class, 'show'])->name('product.show');
Route::resource('products', ProductController::class)->except(['show']);


Route::get('/all_categories', [CategoryController::class, 'view'])->name('category.view');
Route::get('/category/{category}/{slug?}', [CategoryController::class, 'show'])->name('category.show');
Route::resource('categories', CategoryController::class);

Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('thankyou');
Route::prefix('checkout')->group(function () {
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
});

Route::get('/cart', [CartController::class, 'index'])->name('product.cart');
Route::prefix('cart')->group(function () {
    Route::post('/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::get('/contact', [ContactController::class, 'view']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
