<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([

            'categoryName' => 'Art',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Crafts',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Dance',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Design',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Education',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Fashion',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Film & Video',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Food',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Games',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Journalism',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Music',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Photography',

        ]);

        DB::table('categories')->insert([

            'categoryName' => 'Technology',

        ]);
    }
}
