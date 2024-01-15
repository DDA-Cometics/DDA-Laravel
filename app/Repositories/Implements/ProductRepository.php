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
    public function getProduct(): Collection
    {
        return Product::where('display_flag', true)->get();
    }
    public function getNewProduct(): Collection
    {
        return Product::where('display_flag', true)
                    ->where('new_flag', true)
                    ->get();
    }
    public function searchProduct($searchData): Collection
    {
        $searchResults = Product::where(function ($query) use ($searchData) {
            $query->where('product_name', 'like', '%' . $searchData . '%')
            ->orWhere('description', 'like', '%' . $searchData . '%')
            ->orWhere('category', 'like', '%' . $searchData . '%')
            ->orWhere('ingredient', 'like', '%' . $searchData . '%')
            ->orWhere('price', '<=', $searchData);
        })->get();
        return $searchResults;
    }
}