<?php

namespace App\Rules;

use App\Models\Bike;
use App\Repositories\BikeRepositoryInterface;
use Illuminate\Contracts\Validation\Rule;

class AlreadyExists implements Rule
{
    /**
     * @var BikeRepositoryInterface
     */
    private BikeRepositoryInterface $bikeRepository;

    /**
     * BikeService constructor
     *
     * @param BikeRepositoryInterface $bikeRepository
     */
    public function __construct(BikeRepositoryInterface $bikeRepository)
    {
        $this->bikeRepository = $bikeRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return !$this->bikeRepository->checkIsBikeAdded($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Bike with this name is already added';
    }
}
