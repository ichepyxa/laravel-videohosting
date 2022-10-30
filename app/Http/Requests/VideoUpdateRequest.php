<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required',
            'video_file' => 'nullable|file|mimes:mp4',
            'cover_file' => 'nullable|file|mimes:jpg,jpeg',
        ];
    }
}