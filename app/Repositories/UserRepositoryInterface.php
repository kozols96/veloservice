<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * @return Collection|null
     */
    public function all(): ?Collection;

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User;

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User;

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * @param string $email
     * @return bool
     */
    public function checkIsEmailRegistered(string $email): bool;

    /**
     * @param string $email
     * @return User|null
     */
    public function checkIfUserExistsByEmail(string $email): ?User;

    /**
     * @param string $name
     * @return Collection
     */
    public function searchUser(string $name): Collection;
}
