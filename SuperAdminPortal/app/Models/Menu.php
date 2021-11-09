<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'id';
    protected $table = 'menus';

    protected $fillable = [
        'restaurant_ID', 'name', 'description', 'image', 'enabled'
    ];

    //Logging
    protected $logName = 'menus';
    protected static $logAttributes = [
        'restaurant_ID', 'name', 'description', 'image', 'enabled'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user()->username) . " has {$eventName} menu";
    }
}
