<?php

namespace App\Services;

use App\Exceptions\BikeNotFoundException;
use App\Models\UserBikeReservation;
use App\Repositories\BikeRepositoryInterface;
use App\Repositories\UserBikeReservationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserBikeReservationService
{
    /**
     * @var UserBikeReservationRepositoryInterface
     */
    private UserBikeReservationRepositoryInterface $userBikeReservationRepository;

    /**
     * @var BikeRepositoryInterface
     */
    private BikeRepositoryInterface $bikeRepository;

    /**
     * @param UserBikeReservationRepositoryInterface $userBikeReservationRepository
     * @param BikeRepositoryInterface $bikeRepository
     */
    public function __construct(
        UserBikeReservationRepositoryInterface $userBikeReservationRepository,
        BikeRepositoryInterface                $bikeRepository)
    {
        $this->userBikeReservationRepository = $userBikeReservationRepository;
        $this->bikeRepository = $bikeRepository;
    }

    public function viewReservations(): Collection
    {
        $user = auth()->user();

        if ($user->is_admin) {
            return $this->userBikeReservationRepository->allByAdmin();
        }

        return $this->userBikeReservationRepository->allByUserId($user->id);
    }

    /**
     * @throws BikeNotFoundException
     * @throws \Exception
     */
    public function addReservation(Request $request): Model|UserBikeReservation
    {
        $userId = $request->user()->id;
        $fields = $this->validateUserBikeReservation($request);

        $bikeId = $fields['bike_id'];

        if (!$this->bikeRepository->findById($bikeId)) {
            throw BikeNotFoundException::withBikeId($bikeId);
        }

        $attributes = [
            'user_id' => $userId,
            'bike_id' => $bikeId,
            'starting_time' => $fields['starting_time'],
            'ending_time' => $fields['ending_time']
        ];

        if ($this->userBikeReservationRepository
            ->checkIfReservationAvailable(
                $bikeId,
                $fields['starting_time'],
                $fields['ending_time']
            )
        ) {
            throw new \Exception('This time is not available');
        }

        return $this->userBikeReservationRepository->create($attributes);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateUserBikeReservation(Request $request): array
    {
        return $request->validate([
            'bike_id' => 'required|numeric',
            'starting_time' => 'required|date',
            'ending_time' => 'required|date'
        ]);
    }
}
