<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

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


Route::get('login',function (){
    return view('login');
});

Route::get('logout',[\App\Http\Controllers\UserController::class,'logout']);
Route::post('login','\App\Http\Controllers\UserController@login')->name('login');
Route::get('register',function (){
    return view('register');
});

// ------- USER CLIENT ------ //
Route::get('/',[\App\Http\Controllers\HomeController::class,'index']);
Route::get('sanpham',[\App\Http\Controllers\HomeController::class,'sanpham']);
Route::get('show/{id}',[\App\Http\Controllers\BrandsController::class,'sanpham']);
Route::get('dathang',[\App\Http\Controllers\OderController::class,'create'])->name('dathang')->middleware('auth');
Route::get('search',[\App\Http\Controllers\SearchController::class,'search'])->name('search');
Route::get('profile/{id}',[\App\Http\Controllers\UserController::class,'profile'])->name('profile')->middleware('auth');
Route::put('avatar/{id}',[\App\Http\Controllers\UserController::class,'uploadimg'])->name('avatar')->middleware('auth');
Route::get('giohang',[\App\Http\Controllers\CartController::class,'index'])->name('giohang');
Route::get('chitiet/{id}',[\App\Http\Controllers\ShoesController::class,'show'])->name('chitiet');
Route::post('capnhatuser/{id}',[\App\Http\Controllers\UserController::class,'update'])->name('capnhatuser');
Route::resource('cart',\App\Http\Controllers\CartController::class)->middleware('auth');
Route::delete('cart/{id}',[\App\Http\Controllers\CartController::class,'destroy']);
Route::post('createoder',[\App\Http\Controllers\OderController::class,'store'])->name('createoder');
Route::get('update-user/{id}',[\App\Http\Controllers\UserController::class,'edit'])->name('update-user');
Route::patch('client-update/{id}',[\App\Http\Controllers\UserController::class,'clientupdate'])->name('client-update');
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::post('register',[\App\Http\Controllers\UserController::class,'store'])->name('register');

// ---------  ADMIN ------------------- //
Route::prefix('admin')->middleware('checkadmin')->group(function () {
  
Route::resource('user',\App\Http\Controllers\UserController::class);
Route::delete('user/{id}',[\App\Http\Controllers\UserController::class,'destroy'])->name('deleteuser');
Route::resource('category',\App\Http\Controllers\CategoriesController::class);
Route::get('category-create',[\App\Http\Controllers\CategoriesController::class,'create']);
Route::get('update-category/{id}',[\App\Http\Controllers\CategoriesController::class,'edit'])->name('update-category');
Route::delete('category/{id}',[\App\Http\Controllers\CategoriesController::class,'destroy']);
Route::resource('brand',\App\Http\Controllers\BrandsController::class);
Route::get('create-brand',[\App\Http\Controllers\BrandsController::class,'create']);
Route::delete('brand/{id}',[\App\Http\Controllers\BrandsController::class,'destroy']);
Route::resource('shoe',\App\Http\Controllers\ShoesController::class);
Route::get('shoes-create',[\App\Http\Controllers\ShoesController::class,'create']);
Route::get('update-shoes/{id}',[\App\Http\Controllers\ShoesController::class,'edit'])->name('update-shoes');
Route::get('shoe/{id}',[\App\Http\Controllers\ShoesController::class,'edit']);
Route::resource('administrator',\App\Http\Controllers\AdminController::class);
Route::resource('oder',\App\Http\Controllers\OderController::class);
Route::delete('oder/{id}',[\App\Http\Controllers\OderController::class,'destroy']);
Route::resource('home',\App\Http\Controllers\HomeController::class);
Route::get('admin-profile',[\App\Http\Controllers\AdminController::class,'profile']);
Route::get('update-oder/{id}',[\App\Http\Controllers\OderController::class,'edit'])->name('update-oder');
Route::patch('update-oder-status/{id}',[\App\Http\Controllers\OderController::class,'updateconditionoder'])->name('update-oder-status');
});
