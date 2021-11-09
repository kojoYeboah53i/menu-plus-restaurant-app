<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCookingPreference extends Model
{
    use HasFactory;
    protected $table = 'order_cooking_preferences';

    protected $fillable = ['order_id', 'cooking_preference_id'];

    //Logging
    protected $logName = 'order_cooking_preferences';
    protected static $logAttributes = ['order_id', 'cooking_preference_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') .
            " has {$eventName} order cooking preference";
    }
}
