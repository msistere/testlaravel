<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

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

Route::get('/clear-view', function() {
    Artisan::call('view:clear');
    return "View is cleared";
});

Route::get('/', function() {
        return redirect('admin/dashboard');
});

Route::get('/admin', function() {
        return redirect('admin/dashboard');
});

Route::group(['prefix' => 'admin'], function () {   
    Route::get('login', function() {
        return view('admin.login');
    })->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {   
    Route::get('dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::resource('categorias', CategoryController::class);
    Route::resource('productos', ProductController::class);
    Route::get('products/data', [ProductController::class, 'data'])->name('products.data');
    Route::resource('productos.tarifas', ProductPriceController::class);
    Route::resource('tarifas', PriceController::class);
    Route::resource('media', MediaController::class);
    Route::get('productos_excel', [ProductController::class, 'excel'])->name('products.excel');
    Route::get('productos/{producto}/pdf', [ProductController::class, 'pdf'])->name('products.pdf');
    Route::resource('pedidos', OrderController::class);
    Route::post('pedidos/form', [OrderController::class, 'form'])->name('pedidos.form');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
