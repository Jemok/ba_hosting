<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Md\User::truncate();

        DB::table('users')->insert([
            'first_name' => 'mother',
            'last_name'  => 'bongo',
            'email'=> 'mother@bongo.com',
            'password' =>  bcrypt('123456'),
            'userCategory' => 4
        ]);

        DB::table('users')->insert([
            'first_name' => 'Expert',
            'last_name'  => 'Expert',
            'email'=> 'expert@bongo.com',
            'password' =>  bcrypt('123456'),
            'userCategory' => 3
        ]);

        DB::table('users')->insert([
            'first_name' => 'Investor',
            'last_name'  => 'Investor',
            'email'=> 'investor@bongo.com',
            'investor_finance' => 1,
            'investor_amount' => 1000000,
            'password' =>  bcrypt('123456'),
            'userCategory' => 2
        ]);

        DB::table('users')->insert([
            'first_name' => 'Innovator',
            'last_name'  => 'Innovator',
            'more_details' => 'I am an Innovator',
            'email'=> 'innovator@bongo.com',
            'password' =>  bcrypt('123456'),
            'userCategory' => 1
        ]);
    }
}
