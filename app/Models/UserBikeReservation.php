<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBikeReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_id',
        'starting_time',
        'ending_time'
    ];
}
