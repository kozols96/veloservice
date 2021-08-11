<?php

namespace App\Repositories\Eloquent;

use App\Models\UserBikeReservation;
use App\Repositories\UserBikeReservationRepositoryInterface;
use Illuminate\Support\Collection;

class UserBikeReservationRepository extends BaseRepository implements UserBikeReservationRepositoryInterface
{
    private UserBikeReservation $userBikeReservation;

    /**
     * @param UserBikeReservation $userBikeReservation
     */
    public function __construct(UserBikeReservation $userBikeReservation)
    {
        parent::__construct($userBikeReservation);
        $this->userBikeReservation = $userBikeReservation;
    }

    /**
     * @inheritDoc
     */
    public function allByUserId(int $id): Collection
    {
        $conditions = [
            'user_bike_reservations.user_id' => $id,
            'users.is_admin' => 0
        ];

        return $this->userBikeReservation
            ->leftJoin('users', 'user_bike_reservations.user_id', '=', 'users.id')
            ->where($conditions)
            ->get(
                [
                    'user_bike_reservations.bike_id',
                    'user_bike_reservations.starting_time',
                    'user_bike_reservations.ending_time'
                ]
            );
    }

    /**
     * @inheritDoc
     */
    public function allByAdmin(): Collection
    {
        return $this->userBikeReservation->all();
    }

    /**
     * @inheritDoc
     */
    public function findReservationById(int $id): UserBikeReservation
    {
        return $this->userBikeReservation->find($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->findReservationById($id)->update($attributes);
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        return $this->findReservationById($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function checkIfReservationAvailable(
        int $bikeId,
        string $startingTime,
        string $endingTime
    ): bool {
        $conditions = [
            'bike_id' => $bikeId,
            ['starting_time', '>=', $startingTime],
            ['ending_time', '<=', $endingTime]
        ];

        return $this->userBikeReservation
            ->where($conditions)
            ->exists();
    }

    /**
     * @inheritDoc
     */
    public function checkIfReservationExistsByUserId(int $id, int $userId): bool
    {
        $conditions = [
          'id' => $id,
          'user_id' => $userId
        ];
        return $this->userBikeReservation->where($conditions)->exists();
    }
}
