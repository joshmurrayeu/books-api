<?php

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
                'category' => 'PHP, Javascript',
                'price' => 9.99,
            ),
            array(
                'isbn' => '978-0596804848',
                'title' => "Ubuntu: Up and Running: A Power User's Desktop Guide",
                'author' => 'Robin Nixon',
                'category' => 'Linux',
                'price' => 12.99,
            ),
            array(
                'isbn' => '978-1118999875',
                'title' => 'Linux Bible',
                'author' => 'Christopher Negus',
                'category' => 'Linux',
                'price' => 19.99,
            ),
            array(
                'isbn' => '978-0596517748',
                'title' => 'JavaScript: The Good Parts',
                'author' => 'Douglas Crockford',
                'category' => 'JavaScript',
                'price' => 8.99,
            ),
        );

        foreach ($books as $book) {
            //
        }
    }
}
