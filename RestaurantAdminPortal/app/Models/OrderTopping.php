<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTopping extends Model
{
    use HasFactory;
    protected $table = 'order_toppings';

    protected $fillable = ['order_id', 'topping_id'];

    //Logging
    protected $logName = 'order_toppings';
    protected static $logAttributes = ['order_id', 'topping_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') .
            " has {$eventName} order toppings";
    }
}
