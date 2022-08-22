<?php

use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\RoleController;
use App\Http\Controllers\AdminController\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('checkLoginAdmin')->prefix('admin')->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });
    Route::controller(RoleController::class)->group(function(){
        Route::get('/role', 'index')->name('role.index');
        Route::get('/role/create', 'create')->name('role.create');
        Route::post('/role/store', 'store')->name('role.store');
        Route::get('/role/edit/{id}', 'edit')->name('role.edit');
        Route::put('/role/update/{id}', 'update')->name('role.update');
        Route::delete('/role/delete/{id}', 'destroy')->name('role.delete');
        Route::delete('/role/deleteMany', 'destroyMany')->name('role.deleteMany');
    });
    Route::controller(UserController::class)->group(function(){
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/create', 'create')->name('user.create');
        Route::post('/user/store', 'store')->name('user.store');
        Route::get('/user/edit/{id}', 'edit')->name('user.edit');
        Route::put('/user/update/{id}', 'update')->name('user.update');
        Route::delete('/user/delete/{id}', 'destroy')->name('user.delete');
        Route::delete('/user/deleteMany', 'destroyMany')->name('user.deleteMany');
    });
}); 