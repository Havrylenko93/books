<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\AuthorServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var AuthorServiceInterface
     */
    protected $authorService;

    /**
     * HomeController constructor.
     * @param AuthorServiceInterface $authorService
     */
    public function __construct(AuthorServiceInterface $authorService)
    {
        $this->middleware('auth');

        $this->authorService = $authorService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $authors = $this->authorService->all();

        return view('home', compact('authors'));
    }
}
