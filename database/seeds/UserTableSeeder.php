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
            'more_details' => 'I am an the mother admin',
            'userCategory' => 4,
            'verified' => 1,
            'hash_id'    => str_random(100)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Expert',
            'last_name'  => 'Expert',
            'email'=> 'expert@bongo.com',
            'bongo_request_id' => '1',
            'more_details' => 'I am an Expert in my field',
            'password' =>  bcrypt('123456'),
            'userCategory' => 3,
            'verified' => 1,
            'hash_id'    => str_random(100)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Investor',
            'last_name'  => 'Investor',
            'email'=> 'investor@bongo.com',
            'investor_request_id' => '1',
            'more_details' => 'I am an Investor',
            'investor_finance' => 1,
            'investor_amount' => 1000000,
            'password' =>  bcrypt('123456'),
            'userCategory' => 2,
            'verified' => 1,
            'hash_id'    => str_random(100)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Innovator',
            'last_name'  => 'Innovator',
            'more_details' => 'I am an Innovator',
            'email'=> 'innovator@bongo.com',
            'password' =>  bcrypt('123456'),
            'userCategory' => 1,
            'verified' => 1,
            'hash_id'    => str_random(100)
        ]);

        DB::table('users')->insert([
            'first_name' => 'Moderator',
            'last_name'  => 'Moderator',
            'email'=> 'moderator@bongo.com',
            'password' =>  bcrypt('123456'),
            'userCategory' => 5,
            'verified' => 1,
            'moderation_count' => 0,
            'hash_id'    => str_random(100)
        ]);
    }
}
