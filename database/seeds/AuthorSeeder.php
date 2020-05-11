<?php

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET foreign_key_checks=0');
        Author::truncate();
        DB::statement('SET foreign_key_checks=1');

        $authors = [
            [
                'name' => 'Joanne Rowling',
            ],
            [
                'name' => 'John Ronald Reuel Tolkien',
            ],
            [
                'name' => 'Sergei Yesenin',
            ],
        ];

        Author::insert($authors);
    }
}
