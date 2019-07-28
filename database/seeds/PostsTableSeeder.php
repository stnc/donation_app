<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many authors you need, defaulting to 10
        $count = (int)$this->command->ask('How many posts do you need ?', 10);

        $this->command->info("Creating {$count} posts.");

        // Create the Genre
        factory(App\Models\Posts::class, $count)->create();

        $this->command->info('Posts Created!');
    }
}
