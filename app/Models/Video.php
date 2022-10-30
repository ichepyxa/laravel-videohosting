<?php

namespace App\Models;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'video_path',
        'cover_path',
        'status'
    ];

    /**
     * Upload video
     *
     * @param null|UploadedFile $file
     * @return void
     */
    public function uploadVideo(?UploadedFile $file): void
    {
        if ($file) {
            if ($this->video_path) {
                Storage::delete($this->video_path);
            }

            $this->video_path = $file->store('public/videos');
            $this->save();
        }
    }

    /**
     * Upload cover
     *
     * @param null|UploadedFile $file
     * @return void
     */
    public function uploadCover(UploadedFile $file)
    {
        if ($file) {
            if ($this->cover_path) {
                Storage::delete($this->cover_path);
            }

            $this->cover_path = $file->store('public/covers');
            $this->save();
        }
    }

    /**
     * Mutator for video url
     *
     * @return UrlGenerator|string
     */
    public function getVideoUrlAttribute(): UrlGenerator|string
    {
        return url(Storage::url($this->video_path));
    }

    /**
     * Mutator for cover url
     *
     * @return UrlGenerator|string
     */
    public function getCoverUrlAttribute(): UrlGenerator|string
    {
        return url(Storage::url($this->cover_path));
    }
}