<?php

namespace App\Services;

use App\Exceptions\UserLoginValidationException;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function signUp(Request $request): JsonResponse
    {
        $fields = $this->validateRegistrationOrFail($request);

        $attributes = [
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ];

        /** @var User $user */
        $user = $this->userRepository->create($attributes);

        $token = $user->createToken(Str::random(60))->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRegistrationOrFail(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function signOut(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws UserLoginValidationException
     */
    public function signIn(Request $request): JsonResponse
    {
        $fields = $this->validateLoginAttempt($request);

        $user = $this->userRepository->checkIfUserExistsByEmail($fields['email']);

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw new UserLoginValidationException();
        }

        $token = $user->createToken(Str::random(60))->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateLoginAttempt(Request $request): array
    {
        return $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    }
}
