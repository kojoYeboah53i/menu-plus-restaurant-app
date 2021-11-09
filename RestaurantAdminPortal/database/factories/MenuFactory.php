<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

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
            'name' => $this->faker->company(),
            'description' => $this->faker->text(100),
            'enabled' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
