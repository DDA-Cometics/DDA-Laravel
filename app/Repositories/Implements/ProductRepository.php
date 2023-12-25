<?php

namespace App\Repositories\Implements;

use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements IProductRepository
{
    protected function getModel(): string
    {
        return Product::class;
    }

    // Dưới đây là Implement
    public function sortPrices(): Collection
    {
        // return Product::select('*')->get();
        return Product::where('display_flag', true)->get();
    }
    
    //...............................................
}
