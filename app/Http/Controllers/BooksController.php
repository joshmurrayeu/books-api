<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Return all of the books
     *
     * @param Request $request
     * @param Book $book
     * @return Book[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request, Book $book)
    {
        // Get the fields of the model so we can check if the client is attemtping to filter
        $fields = array_keys($book->getOriginal());
        $dataFromRequest = $request->all($fields);

        // Is the client attempting to filter by columns that exist?
        if (!empty($dataFromRequest)) {
            // Yep, we have some filters.
            $books = $book->where($dataFromRequest)->get();
        } else {
            // Nope, no filters - return all of the books.
            $books = $book->all();
        }

        return $books;
    }
}
