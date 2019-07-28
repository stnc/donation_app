<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

       // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

           // Call the php artisan migrate:fresh using Artisan
          // $this->command->call('migrate:fresh');

            $this->command->line("Database cleared.");
        }

        //$this->call(AuthorTableSeeder::class);
       // $this->call(BooksTableSeeder::class);

/*
        $this->call(BookAuthorRelationTableSeeder::class);
        $this->call(UserDetailTableSeeder::class);
        $this->call(BooksAuthorsLikeTableSeeder::class);
        $this->call(TaggasblesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CategoriesBookTableSeeder::class);
        $this->call(CategoriesBookRelationTableSeeder::class);
        $this->call(PuplishingHouseTableSeeder::class);
        $this->call(BookPuplisherRelationsTableSeeder::class);
*/


        //-----------------POSTS--------------
         $this->call(PostsTableSeeder::class);
        $this->call(UserDetailTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(CategoriesPostsTableSeeder::class);
        $this->call(CategoriesPostsRelationTableSeeder::class);
        $this->call(PostCommentsTableSeeder::class);
        $this->call(PostsCommentsLikeTableSeeder::class);
        $this->call(PostsTaggasblesTableSeeder::class);

        $this->command->info("Database seeded.");


       // Re Guard model
        Eloquent::reguard();
    }
}
