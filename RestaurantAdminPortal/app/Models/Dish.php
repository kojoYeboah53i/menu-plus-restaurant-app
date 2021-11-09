<?php

namespace App\Models;

use App\Models\Sauce;
use App\Models\Topping;
use App\Models\SideDish;
use App\Models\CookingPreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'dishes';

    protected $fillable = [
        'menu_ID', 'name', 'description', 'chef_note', 'price', 'currency', 'images',
    ];

    public function sauces()
    {
        return $this->hasMany(Sauce::class, 'dish_id');
    }
    public function toppings()
    {
        return $this->hasMany(Topping::class, 'dish_id');
    }
    public function cookingpreferences()
    {
        return $this->hasMany(CookingPreference::class, 'dish_id');
    }
    public function sidedishes()
    {
        return $this->hasMany(SideDish::class, 'dish_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_ID');
    }

    //Logging
    protected $logName = 'dishes';
    protected static $logAttributes = [
        'menu_ID', 'name', 'description', 'chef_note', 'price', 'currency', 'image1','image2', 'image3', 'selected_image', 'active',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} dish";
    }
}
