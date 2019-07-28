<?php

use Illuminate\Database\Seeder;

class PostsTaggasblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Posts::class)->create()->each(function ($post) {
            DB::table('taggables')->insert(
                [
                    'tag_id' => factory(\App\Models\Tag::class)->create()->id,
                    'taggable_id' => $post->id,
                    'taggable_type' => 'posts',
                ]
            );
        });

    }
}
