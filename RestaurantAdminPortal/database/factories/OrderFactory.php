<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1, 100);
        return [
            'dinner_ID' => $this->faker->randomElement([$rand]),
            'waiter_ID' => $this->faker->randomElement([$rand]),
            'total_cost' => $this->faker->randomNumber(2),
            'currency' => $this->faker->currencyCode(),
            'verified' => $this->faker->randomElement(['0', '1']),
            'Payment' => $this->faker->randomElement([
                'billed',
                'not-payed',
                'payed',
            ]),
            'Service' => $this->faker->randomElement([
                'not-served',
                'entree',
                'main',
                'desert',
                'complete',
            ]),
        ];
    }
}
