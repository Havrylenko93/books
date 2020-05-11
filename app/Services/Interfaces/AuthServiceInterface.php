<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface AuthServiceInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function signUp(array $data): User;

    /**
     * @param array $credentials
     * @return mixed
     */
    public function ApiSignIn(array $credentials);
}
