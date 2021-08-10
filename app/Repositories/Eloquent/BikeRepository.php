<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\BikeCollectionNotFound;
use App\Exceptions\BikeNotFoundException;
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
     * @throws BikeNotFoundException
     */
    public function deleteById(int $id): bool
    {
        $bike = $this->findById($id);

        if (!$bike) {
            throw BikeNotFoundException::withBikeId($id);
        }

        return $bike->delete();
    }

    /**
     * @inheritDoc
     */
    public function checkIsBikeAdded(string $name): bool
    {
        return $this->bikeModel->where('name', '=', $name)->exists();
    }

    /**
     * @inheritDoc
     */
    public function searchBike(string $name): Collection
    {
        return $this->bikeModel->where('name', 'like', '%' . $name . '%')->get();
    }
}
