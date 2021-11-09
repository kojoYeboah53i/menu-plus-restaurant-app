<?php

namespace Database\Factories;

use App\Models\Sauce;
use Illuminate\Database\Eloquent\Factories\Factory;

class SauceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sauce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1, 100);
        return [
            'dish_ID' => $this->faker->randomElement([$rand]),
            'name' => $this->faker->sauceName(),
        ];
    }
}
