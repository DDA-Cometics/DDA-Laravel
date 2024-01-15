<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IProductRepository;
use App\Services\Interfaces\IProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;

class ProductService implements IProductService 
{
    function __construct(
        private IProductRepository $ProductRepository
    ){}
    function getProduct(): Collection
    {
        return $this->ProductRepository->getProduct();
    }
    function getNewProduct(): Collection
    {
        return $this->ProductRepository->getNewProduct();
    }
    function create(array $data): mixed
    {
        return $this->ProductRepository->create($data);
    }
    function delete($id): mixed
    {
        return $this->ProductRepository->delete($id);
    }
    function delete1($id): mixed
    {
        return $this->ProductRepository->delete1($id);
    }
    function update($id,array $data): mixed
    {
        return $this->ProductRepository->update($id,$data);
    }
    function searchProduct($searchData):Collection
    {
        return $this->ProductRepository->searchProduct($searchData);
    }
}