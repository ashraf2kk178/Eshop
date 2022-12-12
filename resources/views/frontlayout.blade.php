<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <title>@yield('title')</title>
<!--   bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('lib')}}/bs5/bootstrap.min.css"/>
  <!--     jqueru -->
<script type="text/javascript" src="{{asset('lib')}}/jquery-3.6.0.min.js"></script>
<!--   bs5 js -->
<script type="text/javascript" src="{{asset('lib')}}/bs5/bootstrap.bundle.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('/home')}}">blogg</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/home')}}">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{url('/all-categories')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('/all-categories')}}">show categories</a></li>
          </ul>
        </li>

        @guest
        <li class="nav-item">
          <a class="nav-link " href="{{url('login')}}">login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="{{url('register')}}">register</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link " href="{{url('save_post_form')}}">Add Post</a>
        </li>

         <li class="nav-item">
          <a class="nav-link " href="{{url('manage-posts')}}">Manage posts</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" href="{{url('logout')}}" >logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        </li>
        @endguest

      </ul>
      <form class="d-flex" role="search" action="{{url('/')}}">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
  </div>
</nav>
    <main class="container mt-3">

      @yield('content')

       </main>

</body>
</html>
