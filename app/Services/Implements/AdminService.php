<?php
namespace App\Services\Implements;


use App\Repositories\Interfaces\IAdminRepository;
use App\Services\Interfaces\IAdminService;
use App\Models\User;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Hash;

class AdminService implements IAdminService {
    function __construct(
        private IAdminRepository $AdminRepository
    ){}
    function getProduct(): Collection
    {
        return $this->AdminRepository->getProduct();
    }
    function getUser(): Collection
    {
        return $this->AdminRepository->getUser();
    }
    function getVoucher(): Collection
    {
        return $this->AdminRepository->getVoucher();
    }

    function create(array $data): mixed
    {

        return $this->AdminRepository->create($data);
    }
    function delete($id): mixed
    {

        return $this->AdminRepository->delete($id);
    }
    function update($id,array $data): mixed
    {

        return $this->AdminRepository->update($id,$data);
    }
    public function updatePassword($userId, $newPassword)
    {
        $user = User::find($userId);
    
        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();
        }
    }
}
