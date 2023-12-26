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

    // Dưới đây là Implement
    public function login(): Collection
    {
        // return Product::select('*')->get();
        return user::where('display_flag', true)->get();
    }

    //...............................................
}
