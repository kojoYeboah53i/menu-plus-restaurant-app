<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DinningArea extends Model
{
    use HasFactory, LogsActivity;

    protected $primaryKey = 'id';
    protected $table = 'dining_areas';

    protected $fillable = [
        'name', 'description', 'restaurant_id'
    ];

    //Logging
    protected $logName = 'dining_areas';
    protected static $logAttributes = [
        'name', 'description', 'restaurant_ID'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} dinning area";
    }

    public function waiters(){
        return $this->belongsToMany(Waiter::class, 'working_areas', 'dining_area_ID', 'waiter_ID');
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class, 'restaurant_ID');
    }
}
