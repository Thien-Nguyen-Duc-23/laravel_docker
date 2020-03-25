<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class, 10)->create();
    }
}
