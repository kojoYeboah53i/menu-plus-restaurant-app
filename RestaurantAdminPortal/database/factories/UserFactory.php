<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_id' => Restaurant::factory(),
            'fullname' =>
                $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' =>
                '$2y$10$89h7EAwGZAqohYrieZEEVOEaizNNM53nCJCqr6HkAkkkuWqwskMMq', // secret
            'phone_number' => $this->faker->phoneNumber(),
            'access_rights' => 'all',
            'profile_pic' => null,
        ];
    }
}
