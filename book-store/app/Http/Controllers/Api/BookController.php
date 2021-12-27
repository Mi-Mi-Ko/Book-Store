<?php

namespace App\Http\Controllers\Api;

use Log;
use Illuminate\Http\Request;
use App\Repositories\Book\BookInterface;

class BookController extends Controller
{
    public $book;
    
    public function __construct(BookInterface $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        log::info('getAllBooks.........');
        $books = $this->book->getAllBooks();
        return response()->json([
            "success" => true,
            "message" => "Book are fetched.",
            "data" => $books
        ]);
    }

    public function edit($id)
    {
        log::info('getBookById.........');
        $book = $this->book->getBookById($id);
        return response()->json([
            "success" => true,
            "message" => "Book is fetched.",
            "data" => $book
        ]);
    }
}
