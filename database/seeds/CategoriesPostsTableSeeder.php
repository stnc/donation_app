<?php

use Illuminate\Database\Seeder;

class CategoriesPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('posts_categories')->insert([
            'name' => 'Biography',
        ]);

        DB::table('posts_categories')->insert([
            'name' => 'Business',
        ]);


        DB::table('posts_categories')->insert([
            'name' => 'Education',
        ]);


        DB::table('posts_categories')->insert([
            'name' => 'Kids',
        ]);


        DB::table('posts_categories')->insert([
            'name' => 'Romance',
        ]);


        DB::table('posts_categories')->insert([
            'name' => 'Social Sciences',
        ]);

        DB::table('posts_categories')->insert([
            'name' => 'History',
        ]);

        DB::table('posts_categories')->insert([
            'name' => 'Philosophy',
        ]);
    }
}
