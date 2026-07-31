<?php

namespace Modules\Identity\Services;
use Modules\Identity\Models\User;
use Illuminate\Support\Facades\DB;
class UserService
{
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $role = $data['role'];
            $userData = $data;
            unset($userData['role']);
            $user = User::create($userData);
            $user->assignRole($role);
            return $user;
           

        });
    }
    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $role = $data['role'];
            $userData = $data;
            unset($userData['role']);
            if (blank($userData['password'])) {
    unset($userData['password']);
}
            $user->update($userData);
            $user->syncRoles([$role]);
            return $user;
        });
    }
    public function delete(User $user): bool
    {
       return DB::transaction(function () use ($user) {
            $user->delete();
             return true;

        });
    }
}
