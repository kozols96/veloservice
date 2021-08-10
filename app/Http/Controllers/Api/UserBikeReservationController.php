<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\BikeNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\UserBikeReservation;
use App\Services\UserBikeReservationService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserBikeReservationController extends Controller
{
    /**
     * @var UserBikeReservationService
     */
    private UserBikeReservationService $userBikeReservationService;

    /**
     * @param UserBikeReservationService $userBikeReservationService
     */
    public function __construct(UserBikeReservationService $userBikeReservationService)
    {
        $this->userBikeReservationService = $userBikeReservationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return $this->userBikeReservationService->viewReservations();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserBikeReservation|Model
     * @throws BikeNotFoundException|\Exception
     */
    public function store(Request $request): Model|UserBikeReservation
    {
        return $this->userBikeReservationService->addReservation($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
