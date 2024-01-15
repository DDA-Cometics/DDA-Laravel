<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IUserService
{
    function login($email, $password): mixed;
    function register(array $data): mixed;
    function find($userIdToUpdate);
    function getUsers();
}
