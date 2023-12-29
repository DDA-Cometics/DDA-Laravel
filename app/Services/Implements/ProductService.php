<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IProductRepository;
use App\Services\Interfaces\IProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;

class ProductService implements IProductService {
    function __construct(
        private IProductRepository $ProductRepository
    ){}

    function sortPrices(): Collection
    {
        return $this->ProductRepository->sortPrices();
    }
    function create(array $data): mixed
    {

        return $this->ProductRepository->create($data);
    }
    function delete($id): mixed
    {

        return $this->ProductRepository->delete($id);
    }
    function update($id,array $data): mixed
    {
        
        return $this->ProductRepository->update($id,$data);
    }
}