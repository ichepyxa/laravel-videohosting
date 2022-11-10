<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Video;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show all videos
     * 
     * @return View|Factory
     * */
    public function videos()
    {
        $videos = Video::query()->orderBy('created_at', 'DESC')->get();

        return view('admin', [
            'videos' => $videos,
        ]);
    }

    /**
     * Show video
     * 
     * @param Video $video
     * @return View|Factory
     */
    public function showVideo(Video $video): View|Factory
    {
        return view('video', compact('video'));
    }

    /**
     * Admin auth form
     * 
     * @return View|Factory
     */
    public function authForm(): View|Factory
    {
        return view('login');
    }

    /**
     * Admin logout
     * 
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }

    /**
     * Admin auth
     * 
     * @param AuthRequest $request
     * @return RedirectResponse
     */
    public function auth(AuthRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated())) {
            if (Auth::user()->is_admin) {
                return redirect()->route('videos');
            }

            Auth::logout();
        }

        return redirect()
            ->back()
            ->withErrors(['email' => 'Incorrect user data'])
            ->withInput($request->all());
    }

    /**
     * Change video status
     * 
     * @param Video $video
     * @return RedirectResponse
     */
    public function changeStatus(Video $video): RedirectResponse
    {
        $newStatus = request('status');
        if (in_array($newStatus, Video::$statuses)) {
            $video->status = $newStatus;
            $video->save();
        }

        return redirect()->back();
    }

    /**
     * Delete video
     * 
     * @param Video $video
     * @return RedirectResponse
     */
    public function delete(Video $video): RedirectResponse
    {
        $video->delete();
        return redirect()->route('videos');
    }
}