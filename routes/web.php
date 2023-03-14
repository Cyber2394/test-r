<?php

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
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create']);

Route::post('/products/destroy', [App\Http\Controllers\ProductController::class, 'destroy']);

Route::get('/products/destroy_page', [App\Http\Controllers\ProductController::class, 'destroy_page']);

Route::resource('products', 'App\Http\Controllers\ProductController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/view_products', [App\Http\Controllers\HomeController::class, 'view_products']);
