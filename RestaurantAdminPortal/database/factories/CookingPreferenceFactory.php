<?php

namespace Database\Factories;

use App\Models\CookingPreference;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CookingPreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CookingPreference::class;

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
            'name' => $this->faker->company(),
            'additional_cost' => $this->faker->randomNumber(2),
            'currency' => $this->faker->currencyCode(),
        ];
    }
}
