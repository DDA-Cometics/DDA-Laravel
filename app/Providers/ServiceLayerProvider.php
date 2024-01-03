<?php

namespace App\Providers;

use App\Services\Interfaces\IVoucherService;
use App\Services\Implements\VoucherService;
use App\Services\Interfaces\IProductService;
use App\Services\Implements\ProductService;
use App\Services\Interfaces\IUserService;
use App\Services\Implements\UserService;
use App\Services\Interfaces\IAdminService;
use App\Services\Implements\AdminService;
use App\Services\Interfaces\IDetailProductService;
use App\Services\Implements\DetailProductService;
use App\Services\Interfaces\IShopping_cartService;
use App\Services\Implements\Shopping_cartService;
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
        
        $this->app->singleton(
            IUserService::class,
            UserService::class
        );
        $this->app->singleton(
            IDetailProductService::class,
            DetailProductService::class
        );
        $this->app->singleton(
            IShopping_cartService::class,
            Shopping_cartService::class
        );

        $this->app->singleton(
            \App\Services\Interfaces\IAdminService::class,
            \App\Services\Implements\AdminService::class
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
