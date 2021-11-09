<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'id';
    protected $table = 'orders';

    protected $fillable = [
        'dinner_ID',
        'waiter_ID',
        'total_cost',
        'currency',
        'verified',
        'Payment',
        'Service',
    ];

    public function waiter()
    {
        return $this->belongsTo(Waiter::class, 'waiter_ID');
    }

    //Logging
    protected $logName = 'orders';
    protected static $logAttributes = [
        'dinner_ID',
        'waiter_ID',
        'total_cost',
        'currency',
        'verified',
        'Payment',
        'Service',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') .
            ' ' .
            (auth()->user() ? auth()->user()->lastname : '') .
            " has {$eventName} order";
    }
}
