<?php

namespace App\Services;

use App\Exceptions\BikeNotFoundException;
use App\Models\Bike;

class BikeService
{
    /**
     * @throws BikeNotFoundException
     */
    public function findById(int $id)
    {
        $bike = Bike::where('id', $id)->first();
        if (!$bike) {
            throw new BikeNotFoundException('Bike is not found');
        }
    }
}
