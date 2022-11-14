<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Resources\MyVideoResource;
use App\Models\Video;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VideoManageController extends Controller
{
    /**
     * Get my videos
     * 
     * @return AnonymousResourceCollection 
     */
    public function list(): AnonymousResourceCollection
    {
        return MyVideoResource::collection(Auth::user()->videos);
    }

    /**
     * Create video
     * 
     * @param VideoRequest $request
     * @return Response
     */
    public function store(VideoRequest $request): Response
    {
        /** @var Video $video */
        $video = Auth::user()->videos()->create($request->validated());
        $video->uploadVideo($request->file('video_file'));
        $video->uploadCover($request->file('cover_file'));

        return response()->noContent();
    }

    /**
     * Update video
     * 
     * @param Video $video
     * @param VideoUpdateRequest $request
     * @return Response
     */
    public function update(Video $video, VideoUpdateRequest $request): Response
    {
        if ($video->user_id != Auth::user()->id) {
            return response()->json([
                'message' => 'Forbidden',
            ], 403);
        };

        $video->uploadVideo($request->file('video_file'));
        $video->uploadCover($request->file('cover_file'));

        $video->update([
            'status' => 'on-check',
            ...$request->validated()
        ]);
        $video->save();

        return response()->noContent();
    }

    /**
     * Delete video
     * 
     * @param Video $video
     * @return Response
     */
    public function delete(Video $video): Response
    {
        if ($video->user_id != Auth::user()->id) {
            return response()->json([
                'message' => 'Forbidden',
            ], 403);
        }

        $video->delete();

        return response()->noContent();
    }
}