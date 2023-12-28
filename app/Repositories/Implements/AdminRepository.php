<?php

namespace App\Repositories\Implements;

use App\Models\Admin;
use App\Repositories\Interfaces\IAdminRepository;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    protected function getModel(): string
    {
        return Admin::class;
    }

    // Dưới đây là Implement

    //...............................................
}
