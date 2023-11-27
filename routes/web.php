<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Routing\RouteGroup;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('role')->group(function(){
    Route::get('', [RoleController::class, 'index']);
    Route::post('', [RoleController::class, 'store']);
    Route::put('/{id}', [RoleController::class, 'update']);
    Route::get('/{id}', [RoleController::class, 'show']);
    Route::delete('/{id}', [RoleController::class, 'destroy']);

});

Route::prefix('user')->group(function(){
    Route::get('', [UserController::class, 'index']);
    Route::post('', [UserController::class, 'store']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::put('{id}/role', [UserController::class, 'updateRole']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});