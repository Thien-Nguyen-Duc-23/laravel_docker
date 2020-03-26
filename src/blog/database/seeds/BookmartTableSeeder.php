<?php

use Illuminate\Database\Seeder;
use App\Models\Bookmart;

class BookmartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bookmart::class, 20)->create();
    }
}
