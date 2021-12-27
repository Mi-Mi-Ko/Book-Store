<?php

namespace App\Repositories;

interface BookInterface
{
    public function getAllBooks();

    public function getBookById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteBook($id);
}