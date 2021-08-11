<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class UserBikeReservationTimeValidationException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'This reservation time is not available because someone else took the reservation';

    /**
     * @var int
     */
    protected $code = 500;

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse(['message' => $this->message], $this->code);
    }
}
