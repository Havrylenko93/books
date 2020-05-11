<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookServiceInterface;

class BookService implements BookServiceInterface
{
    /** @var BookRepositoryInterface  */
    protected $bookRepository;

    /**
     * BookService constructor.
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->bookRepository->allPaginated();
    }

    /**
     * @param array $data
     * @return Book
     */
    public function update(array $data): Book
    {
        return $this->bookRepository->updateByArray(
            $this->bookRepository->whereArray(['id' => $data['id']])->first(),
            [
                'title' => $data['title'],
                'year' => $data['year'],
            ]
        );
    }

    /**
     * @param int $bookId
     * @return bool
     */
    public function destroy(int $bookId): bool
    {
        return $this->bookRepository->model->withTrashed()->whereId($bookId)->first()->delete();
    }

}
