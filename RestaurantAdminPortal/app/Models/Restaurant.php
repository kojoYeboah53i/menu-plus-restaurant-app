<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Restaurant extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'id';
    protected $table = 'restaurants';

    protected $fillable = [
        'name', 'address', 'phone_number', 'email', 'subscription', 'status', 'capacity',
        'description', 'logo', 'staff_qr_key', 'customer_qr_key',
    ];

    //Logging
    protected $logName = 'restaurants';
    protected static $logAttributes = [
        'name', 'address', 'phone_number', 'email', 'subscription', 'status', 'capacity',
        'description', 'logo'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->fullname : '') . " has {$eventName} restaurants";
    }
}
