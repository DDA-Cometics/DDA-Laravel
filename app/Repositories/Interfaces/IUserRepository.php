<?php

namespace App\Repositories\Interfaces;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository extends IBaseRepository
{
    function findByEmail(string $email): mixed;
    function find($userIdToUpdate);
    function getUsers();
}