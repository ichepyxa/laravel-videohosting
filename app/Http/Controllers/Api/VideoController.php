<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoFullResource;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    // TODO: phpdoc
    public function search()
    {
        $perPage = request('per_page', 10);
        $videos = Video::query()
            // ->where('status', 'publish') TODO: uncomment
            ->orderBy('created_at', 'DESC');

        // TODO: search

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