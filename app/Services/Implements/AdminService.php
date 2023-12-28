<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IAdminRepository;
use App\Services\Interfaces\IAdminService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;

class AdminService implements IAdminService {
    function __construct(
        private IAdminRepository $AdminRepository
    ){}
    
    
}