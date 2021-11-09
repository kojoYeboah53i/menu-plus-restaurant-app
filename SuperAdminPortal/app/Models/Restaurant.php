<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\RestaurantUser;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'id';
    protected $table = 'restaurants';

    //Logging
    protected $logName = 'restaurants';
    protected static $logAttributes = [
        'name', 'address', 'phone_number', 'email', 'subscription', 'status', 'capacity',
        'description', 'logo',
    ];

    protected $fillable = [
        'name', 'state', 'city', 'suburb', 'post_code', 'address', 'business_type', 'phone_number', 'email', 'status', 'capacity', 'description', 'logo',
    ];

    public function user()
    {
        return $this->hasOne(RestaurantUser::class, 'restaurant_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'restaurant_id');
    }
    
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'restaurant_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return ((auth()->user() ? auth()->user()->firstname : '') . ' ' .  (auth()->user() ? auth()->user()->lastname : '')) . " has {$eventName} restaurant";
    }
}
