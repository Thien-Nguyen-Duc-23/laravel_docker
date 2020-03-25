<?php

use Illuminate\Database\Seeder;

class UserInformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_informations')->insert([
            ['full_name' => 'Admin', 'gender' => config('define.male'), 'date_of_birth' => now(), 'avatar' => 'default.png', 'address' => 'Đà Nẵng', 'phone' => '0932589111', 'account_id' => '1'],
            ['full_name' => 'User', 'gender' => config('define.male'), 'date_of_birth' => now(), 'avatar' => 'default.png', 'address' => 'Đà Nẵng', 'phone' => '0932589222', 'account_id' => '2'],
            ['full_name' => 'SuperAdmin', 'gender' => config('define.male'), 'date_of_birth' => now(), 'avatar' => 'default.png', 'address' => 'Đà Nẵng', 'phone' => '0932589123', 'account_id' => '3'],
            
        ]);
    }
}
