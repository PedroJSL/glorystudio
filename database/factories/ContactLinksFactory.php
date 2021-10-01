<?php

namespace Database\Factories;

use App\Models\ContactLinks;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactLinksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactLinks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'icon' => 'https://picsum.photos/seed/'. rand(0, 99999) .'/200',
            'url' => $this->faker->url(),
            'slug' => $this->faker->word(),
            'user_id' => 1,
        ];
    }
}
