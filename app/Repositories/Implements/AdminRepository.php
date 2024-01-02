<?php

namespace App\Repositories\Implements;

use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use App\Repositories\Interfaces\IAdminRepository;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    protected function getModel(): string
    {
        return Admin::class;
    }

    // Dưới đây là Implement
    public function getProduct(): Collection
    {
        // return Product::select('*')->get();
        return Product::select('*')->get();
    }

    public function getUser(): Collection
    {
        // return Product::select('*')->get();
        return User::select('*')->get();
    }
    public function getVoucher(): Collection
    {
        // return Product::select('*')->get();
        return Voucher::select('*')->get();
    }
    //...............................................
}
