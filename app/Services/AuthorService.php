<?php

namespace App\Services;

use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Services\Interfaces\AuthorServiceInterface;

class AuthorService implements AuthorServiceInterface
{
    /** @var AuthorRepositoryInterface  */
    protected $authorRepository;

    /**
     * AuthorService constructor.
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return $this->authorRepository->allPaginated();
    }
}
