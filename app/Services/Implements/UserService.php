<?php

namespace App\Services\Implements;

use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;

class UserService implements IUserService
{
    function __construct(
        private IUserRepository $UserRepository
    ) {
    }

    function login(array $data): Collection
    {
        return $this->UserRepository->login();
    }
    function register(array $data): mixed
    {
        return $this->UserRepository->create($data);
    }
}
