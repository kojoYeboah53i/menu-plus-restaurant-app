<?php

namespace Database\Factories;

use App\Models\OrderCookingPreference;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderCookingPreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderCookingPreference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1, 100);
        $rand2 = rand(1, 100);
        return [
            'order_id' => $this->faker->randomElement([$rand]),
            'cooking_preference_id' => $this->faker->randomElement([$rand2]),
        ];
    }
}
