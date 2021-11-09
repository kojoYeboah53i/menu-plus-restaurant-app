<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Waiter extends Model
{
    use HasFactory, LogsActivity;

    protected $primaryKey = 'id';
    protected $table = 'waiters';

    protected $fillable = [
        'restaurant_id', 'fullname', 'phone_number', 'pin', 'profile_pic', 'employment_type', 'on_shift',
    ];

    //Logging
    protected $logName = 'waiters';
    protected static $logAttributes = [
        'restaurant_id', 'fullname', 'phone_number', 'pin', 'profile_pic', 'employment_type', 'on_shift',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} waiter";
    }
    
    public function dinning_areas(){
        return $this->belongsToMany(DinningArea::class, 'working_areas', 'waiter_ID', 'dining_area_ID');
    }
}
