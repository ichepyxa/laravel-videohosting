<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function search(Request $request)
    {
        $videos = Video::query()->get();

        // TODO: search video filters

        return $videos;
    }
}