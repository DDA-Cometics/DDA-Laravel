<?php

namespace App\Repositories\Implements;

use App\Models\Detail_product;
use App\Repositories\Interfaces\IDetailProductRepository;
use Illuminate\Database\Eloquent\Collection;

class DetailProductRepository extends BaseRepository implements IDetailProductRepository
{
    protected function getModel(): string
    {
        return Detail_product::class;
    }
    public function getProduct(): Collection
    {
        return Detail_product::where('display_flag', true)
                               ->get();
    }
}
