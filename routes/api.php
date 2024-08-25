<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FurnitureController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcatController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\TrustedController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'loginapi']); //login and create token api
Route::post('/register', [AuthController::class, 'registerapi']); //register api

Route::middleware('auth:sanctum')->group( function(){
    Route::post('/logout', [AuthController::class, 'logoutapi']); //logout and delete token api
    //Furniture api
    Route::resource('furniture', FurnitureController::class)->names([
        'index' => 'furniture.api.index',
        'create' => 'furniture.api.create',
        'store' => 'furniture.api.store',
        'show' => 'furniture.api.show',
        'edit' => 'furniture.api.edit',
        'update' => 'furniture.api.update',
        'destroy' => 'furniture.api.destroy',
    ]); 
    //Categories api
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'categories.api.index',
        'create' => 'categories.api.create',
        'store' => 'categories.api.store',
        'show' => 'categories.api.show',
        'edit' => 'categories.api.edit',
        'update' => 'categories.api.update',
        'destroy' => 'categories.api.destroy',
    ]);
    //Subcategories api
    Route::resource('subcategories', SubcatController::class)->names([
        'index' => 'subcategories.api.index',
        'create' => 'subcategories.api.create',
        'store' => 'subcategories.api.store',
        'show' => 'subcategories.api.show',
        'edit' => 'subcategories.api.edit',
        'update' => 'subcategories.api.update',
        'destroy' => 'subcategories.api.destroy',
    ]);
    //Trusted Partners api
    Route::resource('trusted', TrustedController::class)->names([
        'index' => 'trusted.api.index',
        'show' => 'trusted.api.show',
    ]);
    //Checkout api
    Route::resource('checkout', CheckoutController::class)->names([
        'index' => 'checkout.api.index',
        'create' => 'checkout.api.create',
        'store' => 'checkout.api.store',
        'show' => 'checkout.api.show',
        'edit' => 'checkout.api.edit',
        'update' => 'checkout.api.update',
        'destroy' => 'checkout.api.destroy',
    ]);
    //Get furniture according to category
    Route::get('/furnitureacctocat/{name}',[CategoryController::class, 'getfurniturefromcat']);
    //Get furniture according to subcategory
    Route::get('/furnitureacctosubcat/{id}',[SubcatController::class, 'getfurniturefromsubcat']);
});