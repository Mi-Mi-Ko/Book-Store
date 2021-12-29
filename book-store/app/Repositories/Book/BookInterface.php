<?php

namespace App\Repositories\Book;

interface BookInterface
{
    public function getAllBooks();

    public function getBookById($id);

    public function searchByCategory($id);

    public function createOrUpdate( $id = null, $input = []);

    public function deleteBook($id);
}