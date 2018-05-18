<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Validator::extend('name', '\App\Rules\Name@passes');
        \Blade::component('components.alert', 'alert');
        \Blade::component('components.select-filter', 'selectFilter');
        \Blade::component('components.input-name', 'nameFilter');
        \Blade::component('components.form-filter', 'formFilter');
        \Blade::component('components.input-submit', 'submitButton');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
