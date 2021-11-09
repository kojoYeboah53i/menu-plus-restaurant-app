<?php

namespace Database\Factories;

use App\Models\Waiter;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaiterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Waiter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1, 100);
        return [
            'restaurant_ID' => $this->faker->randomElement([$rand]),
            'fullname' =>
                $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'phone_number' => $this->faker->phoneNumber(),
            'employment_type' => $this->faker->randomElement([
                'casual',
                'part-time',
                'full-time',
            ]),
            'on_shift' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}
