<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tables';

    protected $fillable = [
        'number', 'capacity', 'restaurant_id', 'dining_area_id'
    ];

    public function dinningArea(){
        return $this->belongsTo(DinningArea::class, 'dinning_table_ID');
    }

    //Logging
    protected $logName = 'tables';
    protected static $logAttributes = [
        'number', 'capacity', 'restaurant_id', 'dining_area_id'
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return (auth()->user() ? auth()->user()->firstname : '') . " has {$eventName} table";
    }
}
