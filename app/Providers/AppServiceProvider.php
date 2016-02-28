<?php

namespace cms\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use cms\TopMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Localization::setLocale('id');
        if (Schema::hasTable('top_menu')) {
            $top_menu = TopMenu::all()->sortBy('urutan');
            view()->share('top_menu', $top_menu);
        }
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
