<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Posty</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <nav class="p-6 bg-white flex justify-between">
    <ul class="flex items-center">
      <li>
        <a class="p-3" href="">Home</a>
      </li>
      <li>
        <a class="p-3" href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      <li>
        <a class="p-3" href="{{ route('posts') }}">Post</a>
      </li>
    </ul>
    <ul class="flex items-center">
      @auth
      <li>
        <a class="p-3" href="">{{ explode(' ', auth()->user()->name)[0] }}</a>
      </li>
      <li>
        <form action="{{ route('logout') }}" method="post" class="inline p-3">
        @csrf
        <button type="submit" href="{{ route('logout') }}">Logout</button>
      </form>
      </li>
      @endauth
      @guest
      <li>
        <a class="p-3" href="{{route('login')}}">Login</a>
      </li>
      <li>
        <a class="p-3" href="{{ route('register') }}">Register</a>
      </li>
      @endguest

    </ul>
  </nav>
  @yield('content')
</body>

</html>