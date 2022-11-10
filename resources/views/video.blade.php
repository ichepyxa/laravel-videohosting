@extends('template')

@section('content')
  <h1 class="text-center">{{ $video->title }}</h1>
  <div class="row mb-3">
    <div class="col-6">
      <img src="{{ $video->cover_url }}" alt="" class="w-100 h-100">
    </div>
    <div class="col-6">
      <video src="{{ $video->video_url }}" controls class="w-100"></video>
    </div>
  </div>
  <p>{{ $video->description }}</p>
  <p>Status: <b>{{ $video->status }}</b></p>
  <p>User: <b>{{ $video->user->username }} </b>, Email: <b>({{ $video->user->email }})</b>, ID: <b>{{ $video->id }}</b></p>
@endsection