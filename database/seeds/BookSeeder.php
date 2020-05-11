<?php

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET foreign_key_checks=0');
        Book::truncate();
        DB::statement('SET foreign_key_checks=1');

        $booksArray = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'year' => '1995',
            ],
            [
                'title' => 'The Lord of the Rings',
                'year' => '1937',
            ],
            [
                'title' => 'My way',
                'year' => '1925',
            ],
        ];

        Book::insert($booksArray);

        $authors = \App\Models\Author::all();

        $i = 0;

        foreach (Book::all() as $book) {
            $book->authors()->attach($authors[$i]->id);
            ++$i;
        }
    }
}
