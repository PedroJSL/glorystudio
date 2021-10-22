<?php

namespace Database\Factories;

use App\Models\ProjectImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectImages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_url' => 'https://picsum.photos/seed/'. rand(0, 99999) .'/1920/1080',
            'project_id' => rand(1, 5),
            'order' => 0,
        ];
    }
}
