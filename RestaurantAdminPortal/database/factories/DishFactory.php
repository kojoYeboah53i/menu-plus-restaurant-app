<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        return [
            'menu_ID' => Menu::factory(),
            'name' => $this->faker->foodName(),
            'description' => $this->faker->text(100),
            'ingredients' => $this->faker->sauceName(),
            'price' => $this->faker->randomNumber(2),
            'currency' => $this->faker->currencyCode(),
        ];
    }
}
