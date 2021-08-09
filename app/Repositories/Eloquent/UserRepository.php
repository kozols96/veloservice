<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param User $bikeModel
     */
    public function __construct(User $bikeModel)
    {
        parent::__construct($bikeModel);
    }
}
