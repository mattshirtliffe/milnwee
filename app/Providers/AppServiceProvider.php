<?php

namespace Example\Providers;

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
    	$path = base_path() . DIRECTORY_SEPARATOR . 'MilnweeForHelper' . DIRECTORY_SEPARATOR  . 'Views';
    	$this->loadViewsFrom($path, 'formhelper');
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
