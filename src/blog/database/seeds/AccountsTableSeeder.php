<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            ['email' => 'admin@gmail.com', 'password' => bcrypt('123456789'), 'role_id' => config('define.admin'), 'status' => config('define.active')],
            ['email' => 'user@gmail.com', 'password' => bcrypt('123456789'), 'role_id' => config('define.user'), 'status' => config('define.active')],
            ['email' => 'superAdmin@gmail.com', 'password' => bcrypt('123456789'), 'role_id' => config('define.superAdmin'), 'status' => config('define.active')],
        ]);
    }
}
