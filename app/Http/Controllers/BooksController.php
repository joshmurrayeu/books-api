<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookFullResource;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    /**
     * Return all of the books
     *
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, Book $book)
    {
        // Initialise some variables which will hold some request data
        $author = $request->input('author');
        $category = $request->input('category');

        if (!empty($author) && !empty($category)) {
            // Filtering by Author and Category
            $books = $book->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', "$author");
            })->whereHas('categories', function ($query) use ($category) {
                $query->where('name', 'like', "$category");
            })->get();
        } else if (!empty($author)) {
            // we have an author.
            $books = $book->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', "$author");
            })->get();
        } else if (!empty($category)) {
            // we have a category.
            $books = $book->whereHas('categories', function ($query) use ($category) {
                $query->where('name', 'like', "$category");
            })->get();
        } else {
            // Nope, no filters - return all of the books.
            $books = $book->all();
        }

        return BookResource::collection($books);
    }

    public function create(Request $request)
    {
        // Create a Book
        $validator = Validator::make($request->all(), [
            'isbn' => 'required|unique:books|isbn',
            'title' => 'required',
            'author' => 'required',
            'categories' => 'required',
            'price' => 'required|numeric',
        ], [
            'isbn.isbn' => 'Invalid ISBN'
        ]);

        // Check if it passes
        if ($validator->passes()) {
            // Passed the validation....

            // Does the Author exist already?
            $author = Author::firstOrCreate(['name' => $request->input('author')]);

            // Do the Categories exist already?
            $categories = array();

            foreach (array_map('trim', explode(',', $request->input('categories'))) as $category) {
                $categories[] = Category::firstOrCreate(['name' => $category]);
            }

            // we now have an array of Category (in model form).

            // Create the book and fill it with the values
            $bookObj = new Book();
            $bookObj->fill([
                'isbn' => $request->input('isbn'),
                'title' => $request->input('title'),
                'price' => $request->input('price'),
            ]);
            $bookObj->author()->associate($author);

            // Save the Book, then attach the Categories
            $bookObj->save();

            foreach ($categories as $category) {
                $bookObj->categories()->attach($category->id);
            }

            // Return the Book in full format
            return new BookFullResource($bookObj);
        } else {
            // Failed. Return 400 Bad Request.
            return Response::json($validator->errors(), 400);
        }
    }
}
