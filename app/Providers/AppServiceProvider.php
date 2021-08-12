<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        require_once __DIR__ . '/../Http/helpers.php';

        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        \Illuminate\Http\Resources\Json\JsonResource::withoutWrapping();

        Paginator::defaultView('vendor.pagination.simple-default');
    }
}
