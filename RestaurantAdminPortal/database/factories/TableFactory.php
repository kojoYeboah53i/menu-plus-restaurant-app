<?php

namespace Database\Factories;

use App\Models\DinningArea;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Table::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1, 100);
        return [
            'dining_area_ID' => $this->faker->randomElement([$rand]),
            'number' => $this->faker->randomNumber(2),
            'capacity' => $this->faker->randomNumber(3),
        ];
    }
}
