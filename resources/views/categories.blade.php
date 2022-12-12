@extends('frontlayout')
@section('title', 'All Categories')
@section('content')
   <main class="container mt-4">
          <div class="row">
            <div class="col-md-8">
               <!--  <div class="row mb-5"> -->
            @if(count($categories)>0)
            @foreach($categories as $category)
          <div class="col-md-4">
            <div class="card" style="width: 14rem;">
              <h5 class="card-header">{{$category->title}}</h5>
 <img src="{{asset(asset('imgs/'.$category->image))}}" class="card-img-top" alt="{{$category->title}}">
              <div class="card-body">
  <a href="{{url('category/'.$category->id)}}">{{$category->detail}}</a>
            </div>
              </div>
            </div>
         @endforeach
         @else
         <p class="alert-danger">NO category found FOUND</p>
         @endif
      <!--    </div> -->
            <!--  pagination -->
          {{$categories->links()}}
        <!-- end pagination -->
         </div>
        <!--  right sidebar -->
        <div class="col-md-4 ">
            <!-- search -->
            <div class="card mb-3 shadow">
              <h5 class="card-header">search</h5>
              <div class="card-body">
                      <form class="d-flex" role="search" action="{{url('/')}}">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
        <button class="btn btn-outline-success" type="submit">Search</button>
                      </form>
              </div>  
            </div>
           <!--  end search -->

                 <!-- recent posts -->
            <div class="card mb-3 shadow">
              <h5 class="card-header">recent posts</h5>
              <div class="list-group list-group-flush">
            @if($recent_posts)
                @foreach($recent_posts as $post)
          <a href="" class="list-group-item">{{$post->title}}</a>
                @endforeach
            @endif
              </div>  
            </div>
           <!--  end recent posts -->

        </div>
         <!--  end right sidebar -->
            </div>
       </main>
@endsection
