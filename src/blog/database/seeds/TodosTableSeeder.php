<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('todos')->insert([
                'title' => 'To do ' . $i,
                'note' => str_random(10).' note',
                'status' => rand(0, 1),
            ]);
        }
    }
}
