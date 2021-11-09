<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class RestaurantUser extends Model
{
    use HasFactory, LogsActivity, Notifiable;
    
    protected $primaryKey = 'id';
    protected $table = 'restaurant_users';

    protected $fillable = [
        'restaurant_id', 'fullname', 'phone_number', 'email', 'password', 'access_rights'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    //Logging
    protected $logName = 'restaurant_users';
    protected static $logAttributes = [
        'restaurant_id', 'fullname', 'phone_number', 'email', 'access_rights', 'password', 'profile_pic'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return ((auth()->user() ? auth()->user()->firstname : '') . ' ' .  (auth()->user() ? auth()->user()->lastname : '')) . " has {$eventName} restaurant user";
    }
}
