<?php

use Illuminate\Database\Seeder;

class TaggasblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\A_authors::class)->create()->each(function ($authors) {
            DB::table('taggables')->insert(
                [
                    'tag_id' => factory(\App\Models\Tag::class)->create()->id,
                    'taggable_id' => $authors->id,
                    'taggable_type' => 'authors',
                  //  'taggable_type' => rand(0, 1) == 1 ? 'authors' : 'books'
                ]
            );
        });

        factory(App\Models\A_books::class)->create()->each(function ($books) {
            DB::table('taggables')->insert(
                [
                    'tag_id' => factory(\App\Models\Tag::class)->create()->id,
                    'taggable_id' => $books->id,
                    'taggable_type' => 'books',
                ]
            );
        });

    }
}
