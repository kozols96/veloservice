<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BikeCollectionNotFound extends Exception
{
    /**
     * @var int
     */
    protected $code = 404;

    /**
     * @var string
     */
    protected $message = 'No bike found';

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse(['message' => $this->message], $this->code);
    }
}
