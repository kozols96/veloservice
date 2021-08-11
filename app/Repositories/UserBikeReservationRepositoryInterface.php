<?php

namespace App\Repositories;

use App\Models\UserBikeReservation;
use Illuminate\Support\Collection;

interface UserBikeReservationRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get all reservations by user
     *
     * @param int $id
     * @return Collection
     */
    public function allByUserId(int $id): Collection;

    /**
     * @return Collection
     */
    public function allByAdmin(): Collection;

    /**
     * @param int $id
     * @return UserBikeReservation
     */
    public function findReservationById(int $id): UserBikeReservation;

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * @param int $bikeId
     * @param string $startingTime
     * @param string $endingTime
     * @return bool
     */
    public function checkIfReservationAvailable(
        int $bikeId,
        string $startingTime,
        string $endingTime
    ): bool;

    /**
     * @param int $id
     * @param int $userId
     * @return bool
     */
    public function checkIfReservationExistsByUserId(int $id, int $userId): bool;
}
