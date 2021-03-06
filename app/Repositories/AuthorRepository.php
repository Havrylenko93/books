<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorRepository extends Repository implements AuthorRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function model()
    {
        return Author::class;
    }

    /**
     * @param int $paginate
     * @return LengthAwarePaginator
     */
    public function allPaginated(int $paginate = 2): LengthAwarePaginator
    {
        return parent::allPaginated($paginate);
    }
}
