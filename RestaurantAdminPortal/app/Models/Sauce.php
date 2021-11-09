<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sauce extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'sauces';

    protected $fillable = [
        'dish_id', 'name', 'price',
    ];

    //Logging
    protected $logName = 'sauces';
    protected static $logAttributes = [
        'dish_id', 'name',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} sauce";
    }
}
