<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategoriesPostsRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Posts::class)->create()->each(function ($books) {
            $faker = Faker::create();
            DB::table('posts_categories_relations')->insert([
                'category_id' => rand(1, 8),
                'post_id' => $books->id,
                'created_at'  => $faker->dateTimeInInterval('-7 days'),
                'updated_at'  => $faker->dateTimeInInterval('-7 days'),
            ]);
        });
    }
}
