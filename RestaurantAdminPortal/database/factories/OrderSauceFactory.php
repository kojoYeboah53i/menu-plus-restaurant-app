<?php

namespace Database\Factories;

use App\Models\OrderSauce;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderSauceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderSauce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1, 100);
        return [
            'order_id' => $this->faker->randomElement([$rand]),
            'sauce_id' => $this->faker->randomElement([$rand]),
        ];
    }
}
