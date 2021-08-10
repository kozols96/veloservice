<?php


namespace App\Http\Controllers\Api;

use App\Exceptions\UserLoginValidationException;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        return $this->userService->signUp($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws UserLoginValidationException
     */
    public function login(Request $request): JsonResponse
    {
        return $this->userService->signIn($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->userService->signOut($request);
    }
}
