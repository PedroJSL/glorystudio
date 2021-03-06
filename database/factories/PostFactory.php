<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'image' => 'https://picsum.photos/seed/'. rand(0, 99999) .'/1920/1080',
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->paragraph(),
            'user_id' => 1,
            'post_category_id' => \App\Models\PostCategory::factory(),
            'publication_date' => now(),
        ];
    }
}
