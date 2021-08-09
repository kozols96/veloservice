<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * Creates model
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;
}
