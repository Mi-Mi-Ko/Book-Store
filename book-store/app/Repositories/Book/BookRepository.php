<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Book\BookInterface;
use Illuminate\Support\Facades\Hash;

class BookRepository implements BookInterface
{   
    protected $book = null;

    public function getAllBooks()
    {
        return Book::all();
    }

    public function getBookById($id)
    {
        return Book::find($id);
    }

    public function createOrUpdate( $id = null, $collection = [] )
    {   
        if(is_null($id)) {
            $book = new Book;
            // $book->name = $collection['name'];
            // $book->email = $collection['email'];
            // $book->password = Hash::make('password');
            return $book->save();
        }
        $book = Book::find($id);
        // $book->name = $collection['name'];
        // $book->email = $collection['email'];
        return $book->save();
    }
    
    public function deleteBook($id)
    {
        return Book::find($id)->delete();
    }
}