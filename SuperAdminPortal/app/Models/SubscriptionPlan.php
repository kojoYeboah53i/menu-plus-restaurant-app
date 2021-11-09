<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'subscription_plans';

    //Logging
    protected $logName = 'subscription_plans';
    protected static $logAttributes = [
        'product_id', 'name', 'duration', 'pricing', 
    ];

    protected $fillable = [
        'product_id', 'name', 'duration', 'pricing',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
