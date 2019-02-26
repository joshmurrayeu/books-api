<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Return all of the books
     *
     * @param Request $request
     * @param Book $book
     * @return BookResource
     */
    public function index(Request $request, Book $book)
    {
        // Initialise some variables which will hold some request data
        $author = $request->input('author');

        if (!empty($author)) {
            // we have an author.
            $books = $book->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', "$author");
            })->get();
        } else {
            // Nope, no filters - return all of the books.
            $books = $book->all();
        }

        return BookResource::collection($books);
    }
}
