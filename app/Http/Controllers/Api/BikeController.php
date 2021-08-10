<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\BikeCollectionNotFound;
use App\Exceptions\BikeNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Repositories\BikeRepositoryInterface;
use App\Services\BikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BikeController extends Controller
{
    /**
     * @var BikeRepositoryInterface
     */
    private BikeRepositoryInterface $bikeRepository;

    /**
     * @var BikeService
     */
    private BikeService $bikeService;

    /**
     * BikeController constructor.
     *
     * @param BikeRepositoryInterface $bikeRepository
     * @param BikeService $bikeService
     */
    public function __construct(BikeRepositoryInterface $bikeRepository, BikeService $bikeService)
    {
        $this->bikeRepository = $bikeRepository;
        $this->bikeService = $bikeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->bikeRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Bike|null
     */
    public function store(Request $request): ?Bike
    {
        return $this->bikeService->addBike($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Bike
     * @throws BikeNotFoundException
     */
    public function show(int $id): Bike
    {
        return $this->bikeService->viewBike($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return bool|JsonResponse
     * @throws BikeNotFoundException
     */
    public function update(Request $request, int $id): bool|JsonResponse
    {
        return $this->bikeService->editBike($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     * @throws BikeNotFoundException
     */
    public function destroy(int $id): bool
    {
        return $this->bikeService->removeBike($id);
    }

    /**
     * @param string $name
     * @return Collection
     * @throws BikeCollectionNotFound
     */
    public function search(string $name): Collection
    {
        return $this->bikeService->searchBike($name);
    }
}
