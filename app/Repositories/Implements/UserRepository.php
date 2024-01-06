<?php

namespace App\Repositories\Implements;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected function getModel(): string
    {
        return User::class;
    }

    function findByEmail(string $email): mixed
    {
        return $this->findOneBy(["email" => $email]);
    }


    //...............................................
}
