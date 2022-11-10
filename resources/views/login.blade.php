@extends('template')

@section('content')
  <form action="{{ route('login-send') }}" method="POST">
    @csrf
    <h1 class="text-center text-uppercase">Auth</h1>
    <div class="form-group mt-3">
      <label>Login</label>
      <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">  
      @error('email')
        <span class="text-danger">
          {{$message}}
        </span>
      @enderror
    </div>  
    <div class="form-group mt-3">
      <label>Password</label>
      <input type="password" class="form-control" placeholder="Password" name="password">  
      @error('password')
        <span class="text-danger">
          {{$message}}
        </span>
      @enderror
    </div>  
    <div class="form-group mt-4">
      <input type="submit" class="d-block btn btn-primary btn-lg mx-auto" value="Login">  
    </div> 
  </form>  
@endsection