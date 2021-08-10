<?php

namespace App\Repositories;

use App\Exceptions\BikeCollectionNotFound;
use App\Exceptions\BikeNotFoundException;
use App\Models\Bike;
use Illuminate\Support\Collection;

interface BikeRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get all bikes
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Return bike by id
     *
     * @param int $id
     * @return Bike|null
     */
    public function findById(int $id): ?Bike;

    /**
     * Update bike
     *
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * Delete bike by id
     *
     * @param int $id
     * @return bool
     * @throws BikeNotFoundException
     */
    public function deleteById(int $id): bool;

    /**
     * Check if the bike with name already exists
     *
     * @param string $name
     * @return bool
     */
    public function checkIsBikeAdded(string $name): bool;

    /**
     * Search bike by name
     *
     * @param string $name
     * @return Collection
     */
    public function searchBike(string $name): Collection;
}
