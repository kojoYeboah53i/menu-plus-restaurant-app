<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SideDish extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'side_dishes';

    protected $fillable = [
        'dish_id', 'name', 'price', 'image',
    ];

    //Logging
    protected $logName = 'side_dishes';
    protected static $logAttributes = [
        'dish_id', 'name', 'price', 'image',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} side dish";
    }
}
