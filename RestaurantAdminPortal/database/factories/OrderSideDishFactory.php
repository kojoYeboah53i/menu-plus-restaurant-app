<?php

namespace Database\Factories;

use App\Models\OrderSideDish;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderSideDishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderSideDish::class;

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
            'side_dish_id' => $this->faker->randomElement([$rand]),
        ];
    }
}
