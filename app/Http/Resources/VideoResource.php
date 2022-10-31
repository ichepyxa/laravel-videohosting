<?php

namespace App\Http\Resources;

use App\Models\Video;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => ProfileResource::make($this->user),
            'title' => $this->title,
            'cover_url' => $this->cover_url,
            'date' => $this->created_at,
            'like_count' => $this->likes()->count(),
            'comment_count' => $this->comments()->count(),
        ];
    }
}