<?php

namespace App\Models;

use App\Models\Waiter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    protected $table = 'restaurant_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id', 'username', 'phone_number', 'email', 'password',
    ];

    //Logging
    protected $logName = 'restaurant_users';
    protected static $logAttributes = [
        'restaurant_id', 'username', 'phone_number', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function waiters()
    {
        return $this->hasMany(Waiter::class, 'restaurant_id', 'restaurant_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return ((auth()->user() ? auth()->user()->fullname : '') . " has {$eventName} restaurant user");
    }
}
