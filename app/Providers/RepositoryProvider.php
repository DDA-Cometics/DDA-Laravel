<?php

namespace App\Providers;

use App\Repositories\Implements\BaseRepository;
use App\Repositories\Interfaces\IBaseRepository;
use App\Repositories\Implements\VoucherRepository;
use App\Repositories\Interfaces\IVoucherRepository;
use App\Repositories\Implements\ProductRepository;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    // Map ở trong này
    public function register(): void
    {
        $this->app->singleton(
            IBaseRepository::class,
            BaseRepository::class
        );
        $this->app->singleton(
            IVoucherRepository::class,
            VoucherRepository::class
        );
        $this->app->singleton(
            IProductRepository::class,
            ProductRepository::class
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
