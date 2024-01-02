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

    public function login($email, $password): Collection
    {
        $user = User::where('email', $email)->first();
        $userData = new Collection();

        if ($user && $password === $user->password) {
            $userData->push($user);
        }

        return $userData;
    }



    //...............................................
}
