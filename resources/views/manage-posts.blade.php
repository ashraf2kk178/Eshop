@extends('frontlayout')
@section('title', 'manage post')
@section('content')
   <main class="container mt-4">
          <div class="row">
            <div class="col-md-8 mb-5">
              <h3 class="">Manage post</h3>
             <table class="table table-bordered">
               <tr>
                 <th></th>
               </tr>
             </table>
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
