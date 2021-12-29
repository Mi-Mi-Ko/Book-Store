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

    public function store(Request $request, $id = null)
    {   
        $input = $request->except(['_token','_method']);
        if(!is_null($id)) 
        {
            log::info('Book Update.........');
            $this->book->createOrUpdate($id, $input);
            return redirect()->route('book.edit', ['id' => $id]);
        }
        else
        {
            log::info('Book Create.........');
            $this->book->createOrUpdate($id = null, $input);
            return redirect()->route('book.list');
        }
    }
    
    public function search($id) {
        log::info('Book search by category id.........');
        $books = $this->book->searchByCategory($id);
        return response()->json([
            "success" => true,
            "message" => "Book is fetched by category.",
            "data" => $books
        ]);
    }
}