<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookRepository extends Repository implements BookRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function model()
    {
        return Book::class;
    }

    /**
     * @param int $paginate
     * @return LengthAwarePaginator
     */
    public function allPaginated(int $paginate = 2): LengthAwarePaginator
    {
        return $this->model->with('authors:name')->paginate($paginate);
    }
}
