<?php

namespace Domain\Users\Actions;

use Domain\Users\Data\Resources\UserResource;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class UserStoreAction
{
    public function __invoke(array $data, array $permissions): UserResource
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->givePermissionTo($permissions);

        return UserResource::fromModel($user);
    }
}
