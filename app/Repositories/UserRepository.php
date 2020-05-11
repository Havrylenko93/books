<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => Role::whereSlug(Role::USER_SLUG)->first()->id
        ]);
    }
}
