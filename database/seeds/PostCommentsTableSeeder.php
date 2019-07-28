<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PostCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Posts::class)->create()->each(function ($posts) {
            $faker = Faker::create();
            DB::table('comments')->insert([
                'commentable_type' => 'posts',
                'commentable_id' => $posts->id,
                'user_id' => 1,
                'comment_author' => $faker->name,
                'comment_author_url' => $faker->url,
                'comment_content' => $faker->text(50),
                'comment_approved' => 1,
                'created_at'  => $faker->dateTimeInInterval('-7 days'),
                'updated_at'  => $faker->dateTimeInInterval('-7 days'),

            ]);
        });

    }
}
