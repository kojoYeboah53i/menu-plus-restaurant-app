<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSideDish extends Model
{
    use HasFactory;
    protected $table = 'order_side_dishes';

    protected $fillable = ['order_id', 'side_dish_id'];

    //Logging
    protected $logName = 'order_side_dishes';
    protected static $logAttributes = ['order_id', 'side_dish_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') .
            " has {$eventName} order side dish";
    }
}
