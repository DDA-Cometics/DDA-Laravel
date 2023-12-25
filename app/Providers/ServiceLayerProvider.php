<?php

namespace App\Providers;

use App\Services\Interfaces\IVoucherService;
use App\Services\Implements\VoucherService;
use App\Services\Interfaces\IProductService;
use App\Services\Implements\ProductService;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            IVoucherService::class,
            VoucherService::class
        );

        $this->app->bind(
            \App\Services\Interfaces\IProductService::class,
            \App\Services\Implements\ProductService::class
        );
        

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
