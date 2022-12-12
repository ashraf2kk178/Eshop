@extends('frontlayout')
@section('title', 'Save Post')
@section('content')
   <main class="container mt-4">
          <div class="row">
            <div class="col-md-8 ">
            	<div class=" md-5">
            		<div class="col-md-4">
                  <h3>Add Post Here</h3>
                   @if(Session::has('success'))
                              <p class="text-success"> {{Session::get('success')}} </p>
                              @endif
     <form method="post" action="{{url('save_post_form')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">category</label>
   <select class="form-control" name="category">
    @foreach($cats as $cat)
        <option value="{{$cat->id}}">{{$cat->title}}</option>
    @endforeach
   </select>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">

  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">detail</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="detail">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">tags</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="tags">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">thumb</label>
    <input type="file" class="form-control" id="photo" placeholder="ADD photo" name="post_thumb">
  </div>

 <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">full image</label>
    <input type="file" class="form-control" id="photo" placeholder="ADD photo" name="post_image">
  </div>

  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>                             
</div>
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
            </div>
           <!--  end search -->

                 <!-- recent posts -->
          <!--   <div class="card mb-3 shadow">
              <h5 class="card-header">recent posts</h5>
              <div class="list-group list-group-flush">
            @if($recent_posts)
                @foreach($recent_posts as $post)
          <a href="" class="list-group-item">{{$post->title}}</a>
                @endforeach
            @endif
              </div>  
            </div> -->
           <!--  end recent posts -->

        </div>
         <!--  end right sidebar -->
            </div>
       </main>
@endsection
