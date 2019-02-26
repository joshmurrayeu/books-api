<?php

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of the books
        $books = array(
            array(
                'isbn' => '978-1491918661',
                'title' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
                'author' => 'Robin Nixon',
                'categories' => ['PHP', 'Javascript'],
                'price' => 9.99,
            ),
            array(
                'isbn' => '978-0596804848',
                'title' => "Ubuntu: Up and Running: A Power User's Desktop Guide",
                'author' => 'Robin Nixon',
                'categories' => ['Linux'],
                'price' => 12.99,
            ),
            array(
                'isbn' => '978-1118999875',
                'title' => 'Linux Bible',
                'author' => 'Christopher Negus',
                'categories' => ['Linux'],
                'price' => 19.99,
            ),
            array(
                'isbn' => '978-0596517748',
                'title' => 'JavaScript: The Good Parts',
                'author' => 'Douglas Crockford',
                'categories' => ['JavaScript'],
                'price' => 8.99,
            ),
        );

        foreach ($books as $book) {
            // Does the Author exist already?
            $author = Author::firstOrCreate(['name' => $book['author']]);

            // Do the Categories exist already?
            $categories = array();

            foreach ($book['categories'] as $category) {
                $categories[] = \App\Models\Category::firstOrCreate(['name' => $category]);
            }

            // we now have an array of Category (in model form).

            // Unset the Author name and Categories from the array otherwise the Book::create() method will freak
            unset($book['author']);
            unset($book['categories']);

            // Create the book and fill it with the values
            $bookObj = new Book();
            $bookObj->fill($book);
            $bookObj->author()->associate($author);

            // Save the Book, then attach the Categories
            $bookObj->save();

            foreach ($categories as $category) {
                $bookObj->categories()->attach($category->id);
            }
        }
    }
}
