<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('products');
// });

Route::get('/', [ProductController::class, 'products'])->name('products');
Route::post('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::post('/product/delete', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/pagination/paginate-data', [ProductController::class, 'pagination']);
