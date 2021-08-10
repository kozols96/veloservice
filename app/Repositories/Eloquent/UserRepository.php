<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected User $userModel;

    /**
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        parent::__construct($userModel);
        $this->userModel = $userModel;
    }

    /**
     * @inheritDoc
     */
    public function all(): ?Collection
    {
        return $this->userModel->all();
    }

    /**
     * @inheritDoc
     */
    public function getUserById(int $id): ?User
    {
        return $this->userModel->find($id);
    }

    /**
     * @inheritDoc
     */
    public function getUserByEmail(string $email): ?User
    {
        return $this->userModel->where('email', $email)->first();
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->getUserById($id)->update();
    }

    /**
     * @inheritDoc
     */
    public function checkIsEmailRegistered(string $email): bool
    {
        return $this->userModel->where('email', $email)->exists();
    }

    /**
     * @inheritDoc
     */
    public function checkIfUserExistsByEmail(string $email): ?User
    {
        return $this->userModel->where('email', $email)->first();
    }

    /**
     * @inheritDoc
     */
    public function searchUser(string $name): Collection
    {
        return $this->userModel->where('name', 'like', '%' . $name . '%')->get();
    }
}
