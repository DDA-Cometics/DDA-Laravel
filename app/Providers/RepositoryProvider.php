<?php

namespace App\Providers;

use App\Repositories\Implements\BaseRepository;
use App\Repositories\Interfaces\IBaseRepository;
use App\Repositories\Implements\VoucherRepository;
use App\Repositories\Interfaces\IVoucherRepository;
use App\Repositories\Implements\ProductRepository;
use App\Repositories\Interfaces\IProductRepository;
use App\Repositories\Implements\UserRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\Implements\AdminRepository;
use App\Repositories\Interfaces\IAdminRepository;
use App\Repositories\Implements\DetailProductRepository;
use App\Repositories\Interfaces\IDetailProductRepository;
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
        $this->app->singleton(
            IUserRepository::class,
            UserRepository::class
        );
        $this->app->singleton(
            IAdminRepository::class,
            AdminRepository::class
        );
        $this->app->singleton(
            IDetailProductRepository::class,
            DetailProductRepository::class
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
