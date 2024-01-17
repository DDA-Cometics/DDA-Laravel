<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IDetailProductRepository;
use App\Services\Interfaces\IDetailProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;

class DetailProductService implements IDetailProductService 
{
    function __construct(
        private IDetailProductRepository $DetailProductRepository
    ){}
    function getProduct(): Collection
    {
        return $this->DetailProductRepository->getProduct();
    }
    function create(array $data): mixed
    {
        return $this->DetailProductRepository->create($data);
    }
    function findById($id):mixed
    {
        return $this->DetailProductRepository->findById($id);
    }
}