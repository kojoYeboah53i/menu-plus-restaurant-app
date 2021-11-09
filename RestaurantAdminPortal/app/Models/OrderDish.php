<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDish extends Model
{
    use HasFactory;
    protected $table = 'order_dishes';

    protected $fillable = ['order_id', 'dish_id'];

    //Logging
    protected $logName = 'order_dishes';
    protected static $logAttributes = ['order_id', 'dish_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') .
            " has {$eventName} order dish";
    }
}
