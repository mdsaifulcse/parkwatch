<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Closure;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //app authentication - roles
        Blade::if('roles', function ($roles = null) {
            $roles = explode(',', $roles);
            foreach ($roles as $role)
            {
                if (auth()->check() && auth()->user()->hasRole($role))
                {
                    return true;
                }
            }
            return false;
        });

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
