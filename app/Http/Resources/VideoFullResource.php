<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoFullResource extends JsonResource
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
            'description' => $this->description,
            'video_url' => $this->video_url,
            'cover_url' => $this->cover_url,
            'date' => $this->created_at,
            'like_count' => $this->likes()->count(),
            'comment_count' => $this->comments()->count(),
        ];
    }
}