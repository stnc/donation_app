<?php

use Illuminate\Database\Seeder;

class PostsCommentsLikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*factory(App\Models\Comments::class)->create()->each(function ($co) {
            DB::table('posts_comments_likes')->insert([
                'liketable_type' => 'posts',
                'liketable_id' => $co->id
            ]);
        });
        */

        DB::table('posts_comments_likes')->insert([
            'liketable_type' => 'posts',
            'liketable_id' => 1
        ]);


        DB::table('posts_comments_likes')->insert([
            'liketable_type' => 'posts',
            'liketable_id' => 2
        ]);


        DB::table('posts_comments_likes')->insert([
            'liketable_type' => 'posts',
            'liketable_id' => 3
        ]);



        DB::table('posts_comments_likes')->insert([
            'liketable_type' => 'posts',
            'liketable_id' => 4
        ]);

    }
}
