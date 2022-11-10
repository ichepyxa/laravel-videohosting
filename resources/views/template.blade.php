<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>VideoHosting</title>
  <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</head>

<body>
  <main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar position-fixed"
      style="width: 280px;height: 100vh;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="fa-solid fa-video me-2"></i>
        <span class="fs-4">VideoHosting</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        @auth
          <li>
            <a href="{{ route('videos') }}" class="nav-link text-white">
              <i class="fa-solid fa-video"></i>
              Videos
            </a>
          </li>
          <li>
            <a href="{{ route('logout') }}" class="nav-link text-white">
              <i class="fa-solid fa-right-from-bracket"></i>
              Logout
            </a>
          </li>
        @endauth
        @guest
          <li>
            <a href="{{ route('login') }}" class="nav-link text-white">
              <i class="fa-solid fa-user"></i>
              Login
            </a>
          </li>
        @endguest
      </ul>
    </div>
    <div class="container pt-5" style="padding-left: 280px">

      @yield('content')

    </div>
  </main>
</body>

</html>