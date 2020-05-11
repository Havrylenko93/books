<?php

namespace App\Services;

use App\Exceptions\InvalidPasswordException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use JWTAuth;

class AuthService implements AuthServiceInterface
{
    /** @var UserRepositoryInterface  */
    protected $userRepository;

    /**
     * AuthService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function signUp(array $data): User
    {
        return $this->userRepository->store($data);
    }

    /**
     * @param array $credentials
     * @return mixed
     * @throws InvalidPasswordException
     */
    public function ApiSignIn(array $credentials)
    {
        $user = $this->userRepository->whereFirst(['email' => $credentials['email']]);

        if (!password_verify($credentials['password'], $user->password)) {
            throw new InvalidPasswordException();
        }

        $user['access_token'] = JWTAuth::fromUser($user);

        return $user;
    }

    /**
     * @param User $user
     * @return string
     */
    protected function makeTokenForUser(User $user): string
    {
        return $user->createToken('access-token')->plainTextToken;
    }
}
