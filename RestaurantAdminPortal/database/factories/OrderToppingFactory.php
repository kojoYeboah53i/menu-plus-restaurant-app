<?php

namespace Database\Factories;

use App\Models\OrderTopping;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderToppingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderTopping::class;

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
            'topping_id' => $this->faker->randomElement([$rand]),
        ];
    }
}
