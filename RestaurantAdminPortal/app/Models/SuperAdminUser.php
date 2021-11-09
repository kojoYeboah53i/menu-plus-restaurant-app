<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuperAdminUser extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'access_rights',
        'profile_pic',
        'username',
        'email',
        'number',
        'password',
        'activated',
        'verification_code',
    ];

    //Logging
    protected $logName = 'users';
    protected static $logAttributes = [
        'firstname',
        'lastname',
        'access_rights',
        'profile_pic',
        'username',
        'email',
        'number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
