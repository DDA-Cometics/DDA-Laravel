<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;

interface IShopping_cartService {
   function create($data):mixed;
   function returnProductWithCart():Collection;
}