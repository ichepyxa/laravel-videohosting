<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'video_file' => 'required|file|mimes:mp4',
            'cover_file' => 'required|file|mimes:jpg,jpeg',
        ];
    }
}