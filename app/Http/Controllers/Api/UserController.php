<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get user profile
     *
     * @return array
     */
    public function profile(): array
    {
        /** @var User $user */
        $user = $this->user();

        return [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ];
    }

    /**
     * Update user profile
     *
     * @return Response
     */
    public function update(ProfileRequest $request): Response
    {
        $password = $request->password
            ? Hash::make($request->password)
            : $this->user()->password;

        $this->user()->update([...$request->validated(), 'password' => $password]);

        return response()->noContent();
    }

    /**
     * Get auth user
     *
     * @return ?Authenticatable
     */
    private function user(): ?Authenticatable
    {
        return Auth::user();
    }
}