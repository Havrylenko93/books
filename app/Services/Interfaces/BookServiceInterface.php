<?php

namespace App\Services\Interfaces;

use App\Models\Book;

interface BookServiceInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $data
     * @return Book
     */
    public function update(array $data): Book;

    /**
     * @param int $bookId
     * @return bool
     */
    public function destroy(int $bookId): bool;
}
