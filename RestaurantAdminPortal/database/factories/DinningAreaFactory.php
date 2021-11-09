<?php

namespace Database\Factories;

use App\Models\DinningArea;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class DinningAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DinningArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1, 100);
        return [
            'restaurant_id' => $this->faker->randomElement([$rand]),
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->text(100),
        ];
    }
}
