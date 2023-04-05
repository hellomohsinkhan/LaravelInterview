<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
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
Route::group(['prefix' => 'admin'] ,function() {    
    Route::get('/',[AuthController::class, 'AdminLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');   
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'] ,function() {    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/destroy', [DashboardController::class, 'destroy'])->name('admin.user.delete');
    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');
    ///Product 
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/product/add', [ProductController::class, 'add'])->name('admin.product.add');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::post('/product/delete', [ProductController::class, 'destroy'])->name('admin.product.delete');
});