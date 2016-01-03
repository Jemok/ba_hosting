<?php

use Illuminate\Database\Seeder;

class ProfpicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Md\Profpic::truncate();

        DB::table('profpics')->insert([
            'image' => '11491.jpeg',
            'user_id' => 1

        ]);

        DB::table('profpics')->insert([
            'image' => '14987.jpeg',
            'user_id' => 2

        ]);

        DB::table('profpics')->insert([
            'image' => '22929.jpeg',
            'user_id' => 3
        ]);

        DB::table('profpics')->insert([
            'image' => '33555.jpeg',
            'user_id' => 4
        ]);
    }
}
