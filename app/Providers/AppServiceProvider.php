<?php

namespace App\Providers;

use App\Models\AdminModel\CategoryModel;
use App\Models\AdminModel\ConfigModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $configWeb = ConfigModel::first();
        View::share('config', $configWeb);
    }
}
