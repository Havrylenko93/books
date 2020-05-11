<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateBookRequest;
use App\Models\Book;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /** @var BookServiceInterface  */
    protected $bookService;

    /**
     * BookController constructor.
     * @param BookServiceInterface $bookService
     */
    public function __construct(BookServiceInterface $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return Response::success($this->bookService->all());
    }

    /**
     * @param Book $book
     * @return mixed
     */
    public function get(Book $book)
    {
        return Response::success($book);
    }

    /**
     * @param UpdateBookRequest $request
     * @return mixed
     */
    public function update(UpdateBookRequest $request)
    {
        return Response::success($this->bookService->update($request->all()));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return Response::success($this->bookService->destroy($id));
    }
}
