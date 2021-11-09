<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookingPreference extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'cooking_preferences';

    protected $fillable = [
        'dish_id', 'name',
    ];

    public function dish(){ 
        return $this->belongsTo(Dish::class, 'dish_ID');
    }

    //Logging
    protected $logName = 'cooking_preferences';
    protected static $logAttributes = [
        'dish_id', 'name', 'additional_cost',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} cooking preference";
    }
}
