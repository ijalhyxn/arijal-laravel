<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public static function store(array $data)
    {
        return Book::create($data);
    }
}
