<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TrustedpartnerController;
use App\Http\Controllers\WebuserController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	//For Furniture
	Route::get('/furniture', [FurnitureController::class, 'index'])->name('furniture.index');
	Route::get('/furniture/create', [FurnitureController::class, 'create'])->name('furniture.create');
	Route::post('/furniture/store', [FurnitureController::class, 'store'])->name('furniture.store');
	Route::get('/furniture/edit/{id}', [FurnitureController::class, 'edit'])->name('furniture.edit');
	Route::post('/furniture/update/{id}', [FurnitureController::class, 'update'])->name('furniture.update');
	Route::get('/furniture/delete/{id}', [FurnitureController::class, 'delete'])->name('furniture.delete');
	Route::get('/get-subcategories/{categoryId}', [FurnitureController::class, 'getSubcategories'])->name('getsubcategories');

	//For Categories
	Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
	Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
	Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
	Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
	Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
	Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

	//For Trusted Partners
	Route::get('/trustedpartners', [TrustedpartnerController::class, 'index'])->name('trustedpartners.index');
	Route::get('/trustedpartners/create', [TrustedpartnerController::class, 'create'])->name('trustedpartners.create');
	Route::post('/trustedpartners/store', [TrustedpartnerController::class, 'store'])->name('trustedpartners.store');
	Route::get('/trustedpartners/edit/{id}', [TrustedpartnerController::class, 'edit'])->name('trustedpartners.edit');
	Route::post('/trustedpartners/update/{id}', [TrustedpartnerController::class, 'update'])->name('trustedpartners.update');
	Route::get('/trustedpartners/delete/{id}', [TrustedpartnerController::class, 'delete'])->name('trustedpartners.delete');

	//For SubCategories
	Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
	Route::get('/subcategory/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
	Route::post('/subcategory/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
	Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
	Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
	Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategory.delete');

	//For Checkout
	Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
	Route::get('/checkout/create', [CheckoutController::class, 'create'])->name('checkout.create');
	Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
	Route::get('/checkout/delete/{id}', [CheckoutController::class, 'delete'])->name('checkout.delete');

	Route::group(['middleware' => ['role:Superadmin']], function () {

		//For Roles
		Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
		Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
		Route::post('/roles/store', [RolesController::class, 'store'])->name('roles.store');
		Route::get('/roles/edit/{id}', [RolesController::class, 'edit'])->name('roles.edit');
		Route::post('/roles/update/{id}', [RolesController::class, 'update'])->name('roles.update');
		Route::get('/roles/delete/{id}', [RolesController::class, 'delete'])->name('roles.delete');

		//For Permissions
		Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
		Route::get('/permissions/create', [PermissionsController::class, 'create'])->name('permissions.create');
		Route::post('/permissions/store', [PermissionsController::class, 'store'])->name('permissions.store');
		Route::get('/permissions/edit/{id}', [PermissionsController::class, 'edit'])->name('permissions.edit');
		Route::post('/permissions/update/{id}', [PermissionsController::class, 'update'])->name('permissions.update');
		Route::get('/permissions/delete/{id}', [PermissionsController::class, 'delete'])->name('permissions.delete');

		//For Users Management
		Route::get('/users', [UserController::class, 'index'])->name('users.index');
		Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
		Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
		Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
		Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
		Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

		//For Webusers
		Route::get('/webusers', [WebuserController::class, 'index'])->name('webusers.index');
		Route::get('/webusers/create', [WebuserController::class, 'create'])->name('webusers.create');
		Route::post('/webusers/store', [WebuserController::class, 'store'])->name('webusers.store');
		Route::get('/webusers/edit/{id}', [WebuserController::class, 'edit'])->name('webusers.edit');
		Route::post('/webusers/update/{id}', [WebuserController::class, 'update'])->name('webusers.update');
		Route::get('/webusers/delete/{id}', [WebuserController::class, 'delete'])->name('webusers.delete');

	});
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});