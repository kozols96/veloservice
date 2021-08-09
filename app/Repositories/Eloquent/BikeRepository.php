<?php

namespace App\Repositories\Eloquent;

use App\Models\Bike;
use App\Repositories\BikeRepositoryInterface;
use Illuminate\Support\Collection;

class BikeRepository extends BaseRepository implements BikeRepositoryInterface
{
    /**
     * @var Bike
     */
    protected Bike $bikeModel;

    /**
     * BikeRepository constructor
     *
     * @param Bike $bikeModel
     */
    public function __construct(Bike $bikeModel)
    {
        parent::__construct($bikeModel);
        $this->bikeModel = $bikeModel;
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->bikeModel->all();
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Bike
    {
        return $this->bikeModel->find($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->findById($id)->update($attributes);
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        return $this->findById($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function checkIsBikeAdded(string $name): bool
    {
        return $this->bikeModel->where('name', '=', $name)->exists();
    }
}
