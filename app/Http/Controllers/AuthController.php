<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            'password' => $hash_password,
            ...$request->validated(),
        ]);

        return response()->json([
            'success' => true,
        ])->setStatusCode(201);
    }
}