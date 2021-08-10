<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BikeNotFoundException extends Exception
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    protected $message = "Bike not found";

    /**
     * @var int
     */
    protected $code = 404;

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

    /**
     * Get the exception's context information.
     *
     * @return array
     */
    public function context(): array
    {
        return ['id' => $this->id];
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse(['message' => $this->message], $this->code);
    }
}
