<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\MediaController;

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
    return view('admin.index'); 
});

Route::get('/admin', function () {
        return view('admin.index');
});

Route::group(['prefix' => 'admin'], function () {        
    Route::resource('categorias', CategoryController::class);
    Route::resource('productos', ProductController::class);
    Route::get('products/data', [ProductController::class, 'data'])->name('products.data');
    Route::resource('productos.tarifas', ProductPriceController::class);
    Route::resource('tarifas', PriceController::class);
    Route::resource('media', MediaController::class);
    Route::get('productos_excel', [ProductController::class, 'excel'])->name('products.excel');
    Route::get('productos/{producto}/pdf', [ProductController::class, 'pdf'])->name('products.pdf');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
