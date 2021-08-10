<?php

namespace App\Exceptions;

use Exception;

class BikeNotFoundException extends Exception
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    protected $message = "Bike not found";

    /**
     * @param int $id
     * @return static
     */
    public static function withBikeId(int $id): static
    {
        $e = new self();
        $e->id = $id;
        return $e;
    }

    public static function withBikeName(string $name): static
    {
        $e = new self();
        $e->name = $name;
        return $e;
    }

    /**
     * Get the exception's context information.
     *
     * @return array
     */
    public function context(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
