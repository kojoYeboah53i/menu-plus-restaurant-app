<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'subscriptions';

    //Logging
    protected $logName = 'subscriptions';
    protected static $logAttributes = [
        'plan_id', 'restaurant_id', 'product_id', 'status', 'created_at', 
    ];

    protected $fillable = [
        'plan_id', 'restaurant_id', 'product_id', 'status', 'created_at',
    ];

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
