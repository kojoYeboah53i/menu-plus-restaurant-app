<?php

namespace Database\Factories;

use App\Models\DinningArea;
use App\Models\Waiter;
use App\Models\WorkingArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkingAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkingArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'waiter_ID' => Waiter::factory(),
            'dining_area_ID' => DinningArea::factory(),
        ];
    }
}
