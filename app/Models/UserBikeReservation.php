<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBikeReservation extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'bike_id',
        'starting_time',
        'ending_time'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'starting_time' => 'datetime',
        'ending_time' => 'datetime'
    ];
}
