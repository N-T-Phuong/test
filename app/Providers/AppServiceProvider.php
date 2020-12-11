<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;


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
        Paginator::useBootstrap();

        Gate::before(function($admin) {
            if ($admin->isAdmin()) {
                return true;
            }
            return false;
        } );

        Gate::define('posts.manage', function($admin) {
            if ($admin->isEditor()) 
            {
                return true;
            }
            return false;
        });
        // Gate::define('posts.manage', function($admin) {
        //     if ($admin->isEditor()) 
        //     {
        //         return true;
        //     }
        //     // if ($admin->isModerator())
        //     // {
        //     //     return true;
        //     // }
        //     return false;
        // });
    }
}
