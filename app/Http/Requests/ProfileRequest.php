<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'old_password' => [
                'required_with:password',
                function ($attribute, $value, $fail) {
                    $user = $this->user();
                    if (
                        $this->request->get('password')
                        && !Hash::check($value, $user->password)
                    ) {
                        $fail('Incorrect old password');
                    }
                },
                function ($attribute, $value, $fail) {
                    $password = $this->request->get('password');
                    $old_password = $this->request->get('old_password');
                    if ($password && $old_password && strlen($old_password) < 6) {
                        $fail('The password must be at least 6 characters.');
                    }
                }
            ],
            'password' => [
                'sometimes',
                'confirmed',
                function ($attribute, $value, $fail) {
                    $password = $this->request->get('password');
                    if ($password && strlen($password) < 6) {
                        $fail('The password must be at least 6 characters.');
                    }
                }
            ],
        ];
    }
}