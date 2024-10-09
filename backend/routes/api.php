<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ERPController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ShopCartController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\Super\SupserAuthController;
use App\Models\Product;

Route::get('/user', function (Request $request) {
   return UserResource::make($request->user());
})->middleware('auth:sanctum');

Route::get('/users',function(){
   return User::all();
})->middleware('auth:sanctum');





Route::get('/products', [ProductsController::class, 'index']);
Route::get('/sync-products', [ProductsController::class, 'sync']);
// Route::get('/products', [ProductsController::class, 'index']);
Route::get('products/{id}', [ProductsController::class, 'show'])->name('products.show');


Route::get('/content/{page}', [ContentController::class, 'show']);
Route::post('/content/{page}', [ContentController::class, 'update'])->middleware('auth:sanctum');



// shop cart routes
Route::get('/shop-carts', [ShopCartController::class, 'index']);

Route::post('/shop-carts', [ShopCartController::class, 'store']);


Route::post('/erp/update', [ERPController::class, 'update']);
Route::post('/send-shopping-cart', [ShopCartController::class, 'sendToERP']);

Route::post('/superlogin', [SupserAuthController::class, 'login'])->name('superlogin');
