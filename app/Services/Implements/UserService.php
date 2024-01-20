<?php

namespace App\Services\Implements;

use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    function __construct(
        private IUserRepository $userRepository
    ) {}
    function login($email, $password): mixed
    {
        $user = $this->userRepository->findByEmail($email, $password);

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return null;
    }
    function register(array $data): mixed
    {
        $email=$data['email'];
        $checkEmail=$this->userRepository->findByEmail($email);
        if ($checkEmail){
            return  ["errors" => "email existing"];
        }
        $data["password"] = Hash::make($data["password"]);
        $user =  $this->userRepository->create($data);
        return  $user;
    }
    function find($userIdToUpdate)
    {
        return $this->userRepository->find($userIdToUpdate);
    }
    function getUsers()
    {
        return $this->userRepository->getUsers();
    }

}
