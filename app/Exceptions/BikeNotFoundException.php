<?php

namespace App\Exceptions;
use Exception;

class BikeNotFoundException extends Exception
{
    private int $id;
    protected $message = "Bike not found";

    public static function withBikeId(int $id): self
    {
        $e = new self();
        $e->id = $id;
        return $e;
    }

    /**
     * Get the exception's context information.
     *
     * @return array
     */
    public function context(): array
    {
        return ['id' => $this->id];
    }
}
