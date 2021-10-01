<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

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
            'description' => $this->faker->paragraph(),
            'project_date' => $this->faker->date(),
            'user_id' => 1,
            'project_category_id' => \App\Models\ProjectCategory::factory(),
        ];
    }
}
