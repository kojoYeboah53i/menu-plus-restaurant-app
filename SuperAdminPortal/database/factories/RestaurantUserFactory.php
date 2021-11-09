<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RestaurantUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_id' => Restaurant::factory(),
            'fullname' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$88ccfAK7LgRAfpQUtg8c2O6yh6X.8VwC1JwYnS.CNyzdGMErGpSEG', // secret
            'phone_number' => $this->faker->phoneNumber(),
            'access_rights' => 'all',
            'profile_pic' => null,
        ];
    }
}
