<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->streetAddress(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'subscription' => $this->faker->randomElement(['monthly', 'quarterly', 'annually']),
            'status' => $this->faker->randomElement(['0','1']),
            'capacity' => $this->faker->randomNumber(3),
            'description' => $this->faker->text(100),
            'logo' => null,
        ];
    }
}
