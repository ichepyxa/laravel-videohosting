<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * User registration
     * 
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function registration(RegistrationRequest $request): JsonResponse
    {
        $hash_password = Hash::make($request->password);
        User::query()->create([
            ...$request->validated(),
            'password' => $hash_password,
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    /**
     * User login
     * 
     * @param AuthRequest $request
     * @return array|JsonResponse
     */
    public function auth(AuthRequest $request): array|JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            return [
                'success' => true,
                'token' => $request->user()->createToken('api')->plainTextToken,
            ];
        }

        return response()->json([
            'success' => false,
            'email' => [
                'Incorrect login date',
            ]
        ], 422);
    }

    /**
     * User logout
     * 
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}