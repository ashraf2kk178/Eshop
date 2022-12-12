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
            <li><a class="dropdown-item" href="{{url('/all-categories')}}">shopping cart</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{url('/all-categories')}}">check out</a></li>
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
      <div class="row">
          <div class="col-md-8">
            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif
            <div class="card" style="width: 18rem;">
              <h5 class="card-header">{{$detail->title}}</h5>
              <h6 class="float-right">Total views = {{$detail->views}}</h6>
 <img src="{{asset(asset('imgs/full/'.$detail->full_img))}}" class="card-img-top" alt="{{$detail->title}}">
        <div class="card-body">{{$detail->detail}}</div>
        <div class="card-footer">
        <a href="{{url('category/'.$detail->category->id)}}">{{$detail->category->title}}</a>
      </div>
              </div>
      
            </div>

        <!--  right sidebar -->
        <div class="col-md-4 ">
            <!-- search -->
            <div class="card mb-3 shadow">
              <h5 class="card-header">search</h5>
              <div class="card-body">
                <form action="{{url('/')}}" >
                  <div class="input-group">
  <input type="text" class="form-control" placeholder="" name="q">
  <button class="btn btn-secondary" type="button" id="button-addon1">search</button>
                  </div>
                </form>
              </div>  
            </div>
           <!--  end search -->

                 <!-- recent posts -->
            <div class="card mb-3 shadow">
              <h5 class="card-header">popular posts</h5>
              <div class="list-group list-group-flush">
            @if($popular_posts)
                @foreach($popular_posts as $post)
          <a href="" class="list-group-item">{{$post->title}} <span class="badge bg-info float-right"> {{$post->views}}</span></a>
                @endforeach
            @endif
              </div>  
            </div>
           <!--  end recent posts -->

        </div>
         <!--  end right sidebar -->


           <!-- add comment -->
            <div class="card my-5">
              <h5 class="card-header">Add comments</h5>
            <div class="card-body">
              <form method="post" action="{{url('save-comment/'.$detail->id)}}">
                @csrf
              <textarea class="form-control" name="comment"></textarea>
              <input type="submit" name="" class="btn btn-dark mt-2" />
              </form>
            </div>
            </div>
               <!--  fetch comments -->
               <div class="card my-4">
     <h5 class="card-header">comments <span class="badge bg-dark"> {{count($detail->comments)}}</span></h5>              
                      @if($detail->comments)
                      @foreach($detail->comments as $comment)
                    <figure>
  <blockquote class="blockquote">
     <p>{{$comment->comment}}</p>
  </blockquote>
    @if($comment->user_id==0)
    <figcaption class="blockquote-footer">Admin</figcaption>
    @else
    <figcaption class="blockquote-footer">
  {{$comment->user->name}}
  </figcaption>
    @endif
</figure>
<hr/>
                     @endforeach
                     @endif
               </div>
            </div>

        </main>
        
 <!--    <main class="container mt-3">
        <div class="row">
            <div class="col-md-8">
            </div>
        </div>
 </main>
 -->
    </body>
</html>

