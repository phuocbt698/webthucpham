<?php

use App\Http\Controllers\AdminController\ArticleController;
use App\Http\Controllers\AdminController\BannerController;
use App\Http\Controllers\AdminController\BrandController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\ContactController;
use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\LoginController;
use App\Http\Controllers\AdminController\MemberController;
use App\Http\Controllers\AdminController\OrderController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\RoleController;
use App\Http\Controllers\AdminController\UserController;
use App\Http\Controllers\AdminController\VendorController;
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
            // BrandController
            Route::controller(BrandController::class)->group(function () {
                Route::get('/brand/create', 'create')->name('brand.create');
                Route::post('/brand/store', 'store')->name('brand.store');
                Route::get('/brand/edit/{id}', 'edit')->name('brand.edit');
                Route::put('/brand/update/{id}', 'update')->name('brand.update');
                Route::delete('/brand/delete/{id}', 'destroy')->name('brand.delete');
                Route::delete('/brand/deleteMany', 'destroyMany')->name('brand.deleteMany');
            });

            // ContactController
            Route::controller(ContactController::class)->group(function () {
                Route::delete('/contact/delete/{id}', 'destroy')->name('contact.delete');
                Route::delete('/contact/deleteMany', 'destroyMany')->name('contact.deleteMany');
            });

            // OrderController
            Route::controller(OrderController::class)->group(function () {
                Route::get('/order/create', 'create')->name('order.create');
                Route::post('/order/store', 'store')->name('order.store');
                Route::delete('/order/delete/{id}', 'destroy')->name('order.delete');
                Route::delete('/order/deleteMany', 'destroyMany')->name('order.deleteMany');
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

            // ProductController
            Route::controller(ProductController::class)->group(function () {
                
                Route::delete('/product/delete/{id}', 'destroy')->name('product.delete');
                Route::delete('/product/deleteMany', 'destroyMany')->name('product.deleteMany');
            });

            // MemberController
            Route::controller(MemberController::class)->group(function () {
                Route::get('/member/create', 'create')->name('member.create');
                Route::post('/member/store', 'store')->name('member.store');
                Route::get('/member/edit/{id}', 'edit')->name('member.edit');
                Route::put('/member/update/{id}', 'update')->name('member.update');
                Route::delete('/member/delete/{id}', 'destroy')->name('member.delete');
                Route::delete('/member/deleteMany', 'destroyMany')->name('member.deleteMany');
            });

            // VendorController
            Route::controller(VendorController::class)->group(function () {
                Route::get('/vendor/create', 'create')->name('vendor.create');
                Route::post('/vendor/store', 'store')->name('vendor.store');
                Route::get('/vendor/edit/{id}', 'edit')->name('vendor.edit');
                Route::put('/vendor/update/{id}', 'update')->name('vendor.update');
                Route::delete('/vendor/delete/{id}', 'destroy')->name('vendor.delete');
                Route::delete('/vendor/deleteMany', 'destroyMany')->name('vendor.deleteMany');
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

        // BrandController
        Route::controller(BrandController::class)->group(function () {
            Route::get('/brand', 'index')->name('brand.index');
        });

        // ContactController
        Route::controller(ContactController::class)->group(function () {
            Route::get('/contact', 'index')->name('contact.index');
            Route::get('/contact/show/{id}', 'show')->name('contact.show');
            Route::get('/contact/edit/{id}', 'edit')->name('contact.edit');
            Route::put('/contact/update/{id}', 'update')->name('contact.update');
            Route::post('/contact/feedback/{id}', 'feedback')->name('contact.feedback');
        });

        // OrderController
        Route::controller(OrderController::class)->group(function () {
            Route::get('/order', 'index')->name('order.index');
            Route::get('/order/show/{id}', 'show')->name('order.show');
            Route::get('/order/edit/{id}', 'edit')->name('order.edit');
            Route::put('/order/update/{id}', 'update')->name('order.update');
        });

        // CategoryController
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category', 'index')->name('category.index');
        });

        // ProductController
        Route::controller(ProductController::class)->group(function () {
            Route::get('/product', 'index')->name('product.index');
            Route::get('/product/show/{id}', 'show')->name('product.show');
            Route::get('/product/create', 'create')->name('product.create');
            Route::post('/product/store', 'store')->name('product.store');
            Route::get('/product/edit/{id}', 'edit')->name('product.edit');
            Route::put('/product/update/{id}', 'update')->name('product.update');
        });

         // MemberController
         Route::controller(MemberController::class)->group(function () {
            Route::get('/member', 'index')->name('member.index');
            Route::get('/member/show/{id}', 'show')->name('member.show');
        });

        // VendorController
        Route::controller(VendorController::class)->group(function () {
            Route::get('/vendor', 'index')->name('vendor.index');
            Route::get('/vendor/show/{id}', 'show')->name('vendor.show');
        });
    });
});
