<?php

namespace App\Services;

use App\Exceptions\BikeNotFoundException;
use App\Models\Bike;
use App\Repositories\BikeRepositoryInterface;
use App\Rules\AlreadyExists;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
        $bike = $this->bikeRepository->findById($id);
        if (!$bike) {
            throw BikeNotFoundException::withBikeId($id);
        }

        return $bike;
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
}
