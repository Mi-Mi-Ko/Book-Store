<?php

namespace App\Repositories\Book;

use Log;
use App\Models\Book;
use App\Models\Category;
use App\Repositories\Book\BookInterface;

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

    public function searchByCategory($id) {
        $books = Category::find($id)->books;
        return $books;
    }

    public function createOrUpdate($id = null, $input = [])
    {
        if(is_null($id)) {
            $book = new Book;
            $book->title = $input['title'];
            $book->author = $input['author'];
            $book->description = $input['description'];
            $book->category_id = $input['category_id'];
            $book->rate = $input['rate'];
            $book->publish_date = $input['publish_date'];
            $book->url = $input['url'];
            $book->is_available = $input['is_available'];
            $book->status = $input['status'];
            $book->user_id = 1;
            return $book->save();
        }
        $book = Book::find($id);
        $book->title = $input['title'];
        $book->author = $input['author'];
        $book->description = $input['description'];
        $book->category_id = $input['category_id'];
        $book->rate = $input['rate'];
        $book->publish_date = $input['publish_date'];
        $book->url = $input['url'];
        $book->is_available = $input['is_available'];
        $book->status = $input['status'];
        $book->user_id = 1;
        return $book->save();
    }
    
    public function deleteBook($id)
    {
        return Book::find($id)->delete();
    }
}