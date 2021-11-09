<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSauce extends Model
{
    use HasFactory;
    protected $table = 'order_sauces';

    protected $fillable = ['order_id', 'sauce_id'];

    //Logging
    protected $logName = 'order_sauces';
    protected static $logAttributes = ['order_id', 'sauce_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') .
            " has {$eventName} order sauce";
    }
}
