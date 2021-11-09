<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Dinner extends Model
{
    use HasFactory, LogsActivity;

    protected $primaryKey = 'id';
    protected $table = 'dinners';

    protected $fillable = [
        'lastName',
        'firstName',
        'phoneNumber',
        'email',
        'profile_pic',
    ];

    //Logging
    protected $logName = 'dinners';
    protected static $logAttributes = [
        'lastName',
        'firstName',
        'phoneNumber',
        'email',
        'profile_pic',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') .
            ' ' .
            (auth()->user() ? auth()->user()->lastname : '') .
            " has {$eventName} dinner";
    }
}
