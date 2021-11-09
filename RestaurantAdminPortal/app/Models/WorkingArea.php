<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingArea extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'working_areas';

    protected $fillable = [
        'waiter_ID', 'dining_area_ID',
    ];

    //Logging
    protected $logName = 'working_areas';
    protected static $logAttributes = [
        'waiter_ID', 'dining_area_ID',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} working area";
    }
}
