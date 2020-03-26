<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TodosTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(UserInformationsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(RatesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
