<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AdminValidationException;
use App\Exceptions\BikeNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Repositories\BikeRepositoryInterface;
use App\Services\BikeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return \Illuminate\Support\Collection
     */
    public function index(): \Illuminate\Support\Collection
    {
        return $this->bikeRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Bike|null
     * @throws AdminValidationException
     */
    public function store(Request $request): ?Bike
    {
        return $this->bikeService->addBike($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Model|JsonResponse
     */
    public function show(int $id): Model|JsonResponse
    {
        try {
            return $this->bikeService->viewBike($id);
        } catch (BikeNotFoundException $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
