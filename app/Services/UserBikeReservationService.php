<?php

namespace App\Services;

use App\Exceptions\BikeNotFoundException;
use App\Exceptions\UserBikeReservationsByUserIdException;
use App\Exceptions\UserBikeReservationTimeValidationException;
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

        $attributes = $this->checkIfBikeExistsAndGetFields($fields, $userId);

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

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     * @throws BikeNotFoundException|UserBikeReservationTimeValidationException
     */
    public function editReservation(Request $request, int $id): bool
    {
        $userId = $request->user()->id;
        $fields = $this->validateUserBikeReservation($request);

        $attributes = $this->checkIfBikeExistsAndGetFields($fields, $userId);

        return $this->userBikeReservationRepository->update($id, $attributes);
    }

    /**
     * @param array $fields
     * @param int $userId
     * @return array
     * @throws BikeNotFoundException|UserBikeReservationTimeValidationException
     */
    private function checkIfBikeExistsAndGetFields(array $fields, int $userId): array
    {
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
            throw new UserBikeReservationTimeValidationException();
        }

        return $attributes;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function removeReservation(int $id): bool
    {
        $userId = auth()->user()->id;

        if (!$this->userBikeReservationRepository->checkIfReservationExistsByUserId($id, $userId)) {
            throw new UserBikeReservationsByUserIdException();
        }

        return $this->userBikeReservationRepository->deleteById($id);
    }
}
