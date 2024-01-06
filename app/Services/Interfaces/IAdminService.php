<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IAdminService {
    function getProduct(): Collection;
    public function getUser(): Collection;
    function getVoucher(): Collection;
    function create(array $data): mixed;
    function delete($id): mixed;
    function update($id, array $data): mixed;
    public function updatePassword($userId, $newPassword);
 
   
}
