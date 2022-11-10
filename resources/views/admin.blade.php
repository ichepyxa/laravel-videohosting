@extends('template')

@section('content')
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Video name</th>
        <th scope="col">Author</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>

      @foreach ($videos as $video)
        <tr>
          <th scope="row">{{ $video->id }}</th>
          <td>{{ $video->title }}</td>
          <td>{{ $video->user->username }} ({{ $video->user->email }})</td>
          <td>{{ $video->status }}</td>
          <td class="text-end">
            <a href="{{ route('show-video', $video) }}" class="btn btn-sm btn-primary">View</a>
            @if ($video->status !== 'publish')
              <a href="{{ route('change-status', ['video' => $video, 'status' => 'publish' ]) }}" class="btn btn-sm btn-success">Publish</a>
            @endif
            @if ($video->status !== 'rejected')
              <a href="{{ route('change-status', ['video' => $video, 'status' => 'rejected' ]) }}" class="btn btn-sm btn-warning">Reject</a>
            @endif
            @if ($video->status !== 'arhived')
              <a href="{{ route('change-status', ['video' => $video, 'status' => 'arhived' ]) }}" class="btn btn-sm btn-info">Archive</a>
            @endif
            <a href="{{ route('delete', $video) }}" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>
@endsection