<?php

namespace Database\Factories;

use App\Models\WebStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WebStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'maintenance',
            'status' => false,
        ];
    }
}
