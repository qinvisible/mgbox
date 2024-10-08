<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Login');
});

Route::prefix('role')->group(function(){
    Route::get('', [RoleController::class, 'index'])->name('role.index');;
    Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('create', [RoleController::class, 'create'])->name('role.create');
    Route::post('', [RoleController::class, 'store'])->name('role.store');
    Route::get('/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

});

Route::prefix('user')->group(function(){
    Route::get('', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('', [UserController::class, 'store'])->name('user.store');
    Route::put('{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::prefix('product')->group(function(){
    Route::get('', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('', [ProductController::class, 'store'])->name('product.store');
    Route::get('{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('{id}', [ProductController::class, 'destroy'])->name('product.destroy');;
    Route::post('add-category', [ProductController::class, 'addCategory']);
});

Route::prefix('category')->group(function(){
    Route::get('', [CategoryController::class, 'index'])->name('category.index');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});


Route::prefix('customer')->group(function(){
    Route::get('', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});

Route::prefix('order')->group(function(){
    Route::get('', [OrderController::class, 'index']);
    Route::get('{id}/order-item', [OrderController::class, 'getOrderItems']);
    Route::post('', [OrderController::class, 'store']);
    Route::post('/{id}/add-order', [OrderController::class, 'addOrder']);
    Route::put('{id}', [OrderController::class, 'update']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});
