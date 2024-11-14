<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Dotenv\Dotenv;
/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
