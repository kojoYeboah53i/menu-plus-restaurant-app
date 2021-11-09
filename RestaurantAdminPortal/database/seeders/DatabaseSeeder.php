<?php

namespace Database\Seeders;

use App\Models\CookingPreference;
use App\Models\Dinner;
use App\Models\DinningArea;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderCookingPreference;
use App\Models\OrderDish;
use App\Models\OrderSauce;
use App\Models\OrderSideDish;
use App\Models\OrderTopping;
use App\Models\Sauce;
use App\Models\SideDish;
use App\Models\SuperAdminUser;
use App\Models\Table;
use App\Models\Topping;
use App\Models\User;
use App\Models\WorkingArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $number = 100;
        SuperAdminUser::factory()
            ->count($number)
            ->create();
        User::factory()
            ->hasRestaurant(1)
            ->count($number)
            ->create();
        Dish::factory()
            ->hasMenu(1)
            ->count($number)
            ->create();
        CookingPreference::factory()
            ->hasDish(1)
            ->count($number)
            ->create();
        Dinner::factory()
            ->count($number)
            ->create();
        SideDish::factory()
            ->count($number)
            ->create();
        Sauce::factory()
            ->count($number)
            ->create();
        Topping::factory()
            ->count($number)
            ->create();
        try {
            WorkingArea::factory()
                ->count($number)
                ->create();
        } catch (\Throwable $th) {
            Log::error(['Error' => $th->getMessage()]);
        }
        Table::factory()
            ->hasDinningArea(1)
            ->count($number)
            ->create();
        Order::factory()
            ->count($number)
            ->create();
        try {
            OrderCookingPreference::factory()
                ->count($number)
                ->create();
        } catch (\Throwable $th) {
            Log::error(['Error' => $th->getMessage()]);
        }
        try {
            OrderDish::factory()
                ->count($number)
                ->create();
        } catch (\Throwable $th) {
            Log::error(['Error' => $th->getMessage()]);
        }
        try {
            OrderSauce::factory()
                ->count($number)
                ->create();
        } catch (\Throwable $th) {
            Log::error(['Error' => $th->getMessage()]);
        }
        try {
            OrderSideDish::factory()
                ->count($number)
                ->create();
        } catch (\Throwable $th) {
            Log::error(['Error' => $th->getMessage()]);
        }
        try {
            OrderTopping::factory()
                ->count($number)
                ->create();
        } catch (\Throwable $th) {
            Log::error(['Error' => $th->getMessage()]);
        }
    }
}
