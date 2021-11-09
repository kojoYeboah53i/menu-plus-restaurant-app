<?php

namespace Database\Factories;

use App\Models\OrderDish;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDish::class;

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
            'dish_id' => $this->faker->randomElement([$rand2]),
        ];
    }
}
