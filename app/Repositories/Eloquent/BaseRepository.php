<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Model $bikeModel
     */
    public function __construct(Model $bikeModel)
    {
        $this->model = $bikeModel;
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes)->fresh();
    }
}
