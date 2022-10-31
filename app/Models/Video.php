<?php

namespace App\Models;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
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
     * Video's user relationship
     *
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Has user like on this video
     *
     * @return bool
     */
    public function hasLike(): bool
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    /**
     * Video's likes relationship
     *
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(VideoLike::class, 'video_id', 'id');
    }

    /**
     * Video's comments relationship
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(VideoComment::class, 'video_id', 'id');
    }

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
     * Accessor for video url
     *
     * @return UrlGenerator|string
     */
    public function getVideoUrlAttribute(): UrlGenerator|string
    {
        return url(Storage::url($this->video_path));
    }

    /**
     * Accessor for cover url
     *
     * @return UrlGenerator|string
     */
    public function getCoverUrlAttribute(): UrlGenerator|string
    {
        return url(Storage::url($this->cover_path));
    }
}