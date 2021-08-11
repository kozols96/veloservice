<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserBikeReservationsByUserIdException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'You can\'t delete another user\'s reservation!';

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
