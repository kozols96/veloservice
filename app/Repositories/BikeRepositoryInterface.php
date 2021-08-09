<?php

namespace App\Repositories;

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
     */
    public function deleteById(int $id): bool;

    /**
     * Check if the bike with name already exists
     *
     * @param string $name
     * @return bool
     */
    public function checkIsBikeAdded(string $name): bool;
}
