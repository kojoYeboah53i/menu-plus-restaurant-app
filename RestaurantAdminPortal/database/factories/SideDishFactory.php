<?php

namespace Database\Factories;

use App\Models\SideDish;
use Illuminate\Database\Eloquent\Factories\Factory;

class SideDishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SideDish::class;

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
            'name' => $this->faker->foodName(),
            'price' => $this->faker->randomNumber(2),
            'currency' => $this->faker->currencyCode(),
        ];
    }
}
