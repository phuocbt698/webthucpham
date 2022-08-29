<?php

use App\Http\Controllers\AdminController\ArticleController;
use App\Http\Controllers\AdminController\BannerController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\LoginController;
use App\Http\Controllers\AdminController\RoleController;
use App\Http\Controllers\AdminController\UserController;
use App\Models\AdminModel\UserModel;
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

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');
    Route::controller(LoginController::class)->group(function () {
        Route::post('/login', 'login')->name('admin.login');
        Route::get('/logout', 'logout')->name('admin.logout');
    });
    Route::middleware('checkLoginAdmin')->group(function () {
        //Super Admin
        Route::middleware('checkRoleAdmin')->group(function () {

            // RolerController
            Route::controller(RoleController::class)->group(function () {
                Route::get('/role', 'index')->name('role.index');
                Route::get('/role/create', 'create')->name('role.create');
                Route::post('/role/store', 'store')->name('role.store');
                Route::get('/role/edit/{id}', 'edit')->name('role.edit');
                Route::put('/role/update/{id}', 'update')->name('role.update');
                Route::delete('/role/delete/{id}', 'destroy')->name('role.delete');
                Route::delete('/role/deleteMany', 'destroyMany')->name('role.deleteMany');
            });

            // UserController
            Route::controller(UserController::class)->group(function () {
                Route::get('/user/create', 'create')->name('user.create');
                Route::post('/user/store', 'store')->name('user.store');
                Route::delete('/user/delete/{id}', 'destroy')->name('user.delete');
                Route::delete('/user/deleteMany', 'destroyMany')->name('user.deleteMany');
            });

            // ArticleController
            Route::controller(ArticleController::class)->group(function () {
                Route::get('/article/create', 'create')->name('article.create');
                Route::post('/article/store', 'store')->name('article.store');
                Route::get('/article/edit/{id}', 'edit')->name('article.edit');
                Route::put('/article/update/{id}', 'update')->name('article.update');
                Route::delete('/article/delete/{id}', 'destroy')->name('article.delete');
                Route::delete('/article/deleteMany', 'destroyMany')->name('article.deleteMany');
            });

            // BannerController
            Route::controller(BannerController::class)->group(function () {
                Route::get('/banner/create', 'create')->name('banner.create');
                Route::post('/banner/store', 'store')->name('banner.store');
                Route::get('/banner/edit/{id}', 'edit')->name('banner.edit');
                Route::put('/banner/update/{id}', 'update')->name('banner.update');
                Route::delete('/banner/delete/{id}', 'destroy')->name('banner.delete');
                Route::delete('/banner/deleteMany', 'destroyMany')->name('banner.deleteMany');
            });

            // CategoryController
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/category/create', 'create')->name('category.create');
                Route::post('/category/store', 'store')->name('category.store');
                Route::get('/category/edit/{id}', 'edit')->name('category.edit');
                Route::put('/category/update/{id}', 'update')->name('category.update');
                Route::delete('/category/delete/{id}', 'destroy')->name('category.delete');
                Route::delete('/category/deleteMany', 'destroyMany')->name('category.deleteMany');
            });
        });

        //Admin
        
        // Dashboard
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
        });

        // UserController
        Route::controller(UserController::class)->group(function () {
            Route::get('/user', 'index')->name('user.index');
            Route::get('/user/show/{id}', 'show')->name('user.show');
            Route::get('/user/edit/{id}', 'edit')->name('user.edit');
            Route::put('/user/update/{id}', 'update')->name('user.update');
        });

        // ArticleController
        Route::controller(ArticleController::class)->group(function () {
            Route::get('/article', 'index')->name('article.index');
            Route::get('/article/show/{id}', 'show')->name('article.show');
        });

        // BannerController
        Route::controller(BannerController::class)->group(function () {
            Route::get('/banner', 'index')->name('banner.index');
            Route::get('/banner/show/{id}', 'show')->name('banner.show');
        });

        // CategoryController
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'index')->name('category.index');
        });
    });
});
