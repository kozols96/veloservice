<?php

namespace App\Services;

use App\Exceptions\BikeCollectionNotFound;
use App\Exceptions\BikeNotFoundException;
use App\Models\Bike;
use App\Repositories\BikeRepositoryInterface;
use App\Rules\AlreadyExists;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BikeService
{
    /**
     * @var BikeRepositoryInterface
     */
    private BikeRepositoryInterface $bikeRepository;

    /**
     * BikeService constructor
     *
     * @param BikeRepositoryInterface $bikeRepository
     */
    public function __construct(BikeRepositoryInterface $bikeRepository)
    {
        $this->bikeRepository = $bikeRepository;
    }

    /**
     * @param int $id
     * @return Bike|null
     * @throws BikeNotFoundException
     */
    public function viewBike(int $id): ?Bike
    {
        $this->checkIfBikeExists($id);
        return $this->bikeRepository->findById($id);
    }

    /**
     * @param Request $request
     * @return Bike|Model
     */
    public function addBike(Request $request): Bike|Model
    {
        $this->validateBikeItemOrFail($request);
        return $this->bikeRepository->create($request->all());
    }

    /**
     * @param Request $request
     */
    private function validateBikeItemOrFail(Request $request): void
    {
        $request->validate(['name' => ['required', resolve(AlreadyExists::class)]]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     * @throws BikeNotFoundException
     */
    public function editBike(Request $request, int $id): bool
    {
        $this->checkIfBikeExists($id);
        $this->validateBikeItemOrFail($request);
        return $this->bikeRepository->update($id, $request->all());
    }

    /**
     * @param int $id
     * @return bool
     * @throws BikeNotFoundException
     */
    public function removeBike(int $id): bool
    {
        $this->checkIfBikeExists($id);
        return $this->bikeRepository->deleteById($id);
    }

    /**
     * @param string $name
     * @return Collection
     * @throws BikeCollectionNotFound
     */
    public function searchBike(string $name): Collection
    {
        $bikeCollection = $this->bikeRepository->searchBike($name);

        if ($bikeCollection->isEmpty()) {
            throw new BikeCollectionNotFound();
        }

        return $bikeCollection;
    }

    /**
     * @param int $id
     * @throws BikeNotFoundException
     */
    private function checkIfBikeExists(int $id): void
    {
        if (!$this->bikeRepository->findById($id)) {
            throw BikeNotFoundException::withBikeId($id);
        }
    }
}
