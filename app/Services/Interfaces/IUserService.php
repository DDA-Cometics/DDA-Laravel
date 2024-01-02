<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IUserService
{
    function login($email, $password): Collection;
    function register(array $data): mixed;
}
