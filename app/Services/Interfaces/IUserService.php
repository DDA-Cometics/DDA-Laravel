<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IUserService
{
    function login(): Collection;
}
