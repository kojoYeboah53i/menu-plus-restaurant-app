<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Factor;
use App\Models\User;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =  Factory::create();
        User::create([
            'firstname' => $faker->firstName(),
            'lastname' => $faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'number' => $this->faker->phoneNumber(),
            'verification_code' => null,
            'profile_pic' => null,
            'activated' => $this->faker->randomElement(['0','1']),
            'email_verified_at' => now(),
            'access_rights' => $this->faker->randomElement(['all','write_only','read_only','none']),
            'password' => '$2y$10$Ixhk5tm2klID558IsiuuyemHqy09R4QD7WlGDNBCqRuRP6M9PqXce', // secret
            'remember_token' => Str::random(10),
        ]);
    }
}
