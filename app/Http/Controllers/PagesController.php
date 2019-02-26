<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Show the homepage
     *
     * @param $book Book The Book model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage(Book $book)
    {
        $books = $book->paginate(10);

        return view('homepage', compact('books'));
    }
}
