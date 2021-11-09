<?php

namespace Database\Factories;

use App\Models\SuperAdminUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SuperAdminUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SuperAdminUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'number' => $this->faker->phoneNumber(),
            'verification_code' => null,
            'profile_pic' => null,
            'activated' => $this->faker->randomElement(['0','1']),
            'email_verified_at' => now(),
            'access_rights' => $this->faker->randomElement(['all','write_only','read_only','none']),
            'password' => '$2y$10$88ccfAK7LgRAfpQUtg8c2O6yh6X.8VwC1JwYnS.CNyzdGMErGpSEG', // secret
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
