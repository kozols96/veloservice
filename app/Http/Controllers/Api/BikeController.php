<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\BikeNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Services\BikeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BikeController extends Controller
{

    private BikeService $bikeService;

    /**
     * BikeController constructor.
     * @param BikeService $bikeService
     */
    public function __construct(BikeService $bikeService)
    {
        $this->bikeService = $bikeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection|Bike[]
     */
    public function index(): array|Collection
    {
        return Bike::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|Bike
     */
    public function store(Request $request): Response|Bike
    {
        $request->validate([ 'name' => 'required' ]);

        return Bike::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     * @throws BikeNotFoundException
     */
    public function show(int $id): JsonResponse|Bike
    {
        try {
            $this->bikeService->findById($id);
            return Bike::find($id);
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
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
