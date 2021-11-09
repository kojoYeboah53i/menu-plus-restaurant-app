<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'products';

    //Logging
    protected $logName = 'products';
    protected static $logAttributes = [
        'name', 'features', 
    ];

    protected $fillable = [
        'name', 'features',
    ];

    public function plans()
    {
        return $this->hasMany(SubscriptionPlan::class, 'product_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'product_id');
    }
}
