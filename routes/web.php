<?php

use App\Http\Controllers\Web\Order\OrderController;
use App\Http\Controllers\Web\Product\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [OrderController::class, 'index'])->name('home');
Route::resource('/orders',OrderController::class);

Route::get('/products/restock',[ProductController::class, 'restock'])->name('products.restock');
Route::get('/products/getData/{id}',[ProductController::class, 'getData'])->name('products.getData');
Route::resource('/products',ProductController::class);
Route::post('/products/store-restock',[ProductController::class, 'storeRestock'])->name('products.storerestock');