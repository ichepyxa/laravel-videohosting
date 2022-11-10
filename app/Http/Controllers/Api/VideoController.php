<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoFullResource;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Show and search video
     * 
     * @return AnonymousResourceCollection
     */
    public function search(): AnonymousResourceCollection
    {
        $perPage = request('per_page', 10);
        $searchString = trim(request('search'));
        $videos = Video::query()
            ->where('status', 'publish')
            ->orderBy('created_at', 'DESC');

        if ($searchString) {
            $searchArray = explode(' ', $searchString);
            foreach ($searchArray as $string) {
                $videos->where(function (Builder $query) use ($string) {
                    $query->where(function (Builder $query) use ($string) {
                        $query->where('title', 'like', "%{$string}%");
                        $query->orWhere('description', 'like', "%{$string}%");
                    })->orWhere(function (Builder $query) use ($string) {
                        $query->whereHas('user', function (Builder $query) use ($string) {
                            $query->where('username', 'like', "%{$string}%");
                        });
                    });
                });
            }
        }

        return VideoResource::collection($videos->paginate($perPage));
    }

    /**
     * Get video
     * 
     * @param Video $video
     * @return VideoFullResource
     */
    public function show(Video $video): VideoFullResource
    {
        return VideoFullResource::make($video);
    }

    /**
     * Toggle like
     * 
     * @param Video $video
     * @return Response
     */
    public function toggleLike(Video $video): Response
    {
        if (!$video->hasLike()) {
            $video->likes()->create([
                'user_id' => Auth::id()
            ]);
        } else {
            $video->likes()->where('user_id', Auth::id())->delete();
        }

        return response()->noContent();
    }
}