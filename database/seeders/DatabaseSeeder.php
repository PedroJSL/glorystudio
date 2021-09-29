<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create();
        \App\Models\WebStatus::factory()->create();

        \App\Models\Project::factory(5)->create();
        \App\Models\Post::factory(10)->create();
        \App\Models\SocialMedia::factory(5)->create();
        \App\Models\ContactLinks::factory(3)->create();
    }
}
