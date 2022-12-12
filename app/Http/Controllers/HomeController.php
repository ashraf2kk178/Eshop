<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
$q = $request->q;
$posts = Post::where('title','like', '%'.$q.'%')->orderBy('id', 'desc')->paginate(2);
        }else{
     $posts = Post::orderBy('id', 'desc')->paginate(2);
        }

        return view('home',['posts'=>$posts]);
    }


     function all_category(){

        $categories = Category::orderBy('id', 'desc')->paginate(2);
        return view('categories', ['categories'=>$categories]);
    }


    function detail(Request $request,$postId){

         Post::find($postId)->increment('views');
        $detail = Post::find($postId);
        return view('detail', ['detail'=>$detail]);
    }

    // all posts according from categories
    function category(Request $request,$cat_id){
  $category = Category::find($cat_id);     
  $posts = Post::where('cat_id', $cat_id)->orderBy('id', 'desc')->paginate(1);
  return view('category', ['posts'=>$posts, 'category'=>$category]);      
    }

    function save_comment(Request $request,$id){

        $request->validate([

          'comment'=>'required'
        ]);
        $data = new Comment;
        $data->user_id=$request->user()->id;
        $data->post_id=$id;
        $data->comment=$request->comment;
        $data->save();
        // return redirect('detail/'.$slug.'/'.$id)->with('success', 'comment has been submitted');
        return redirect('detail/'.$id)->with('success', 'comment has been submitted');
    }

    // user save posts
    function save_post_form(){
        $cats = Category::all();
        return view('save_post_form',['cats'=>$cats]);
    }

    // save data

    function save_post_data(Request $request){
         $this->validate($request,[
            'title'=>'required | max:200',
            'category'=>'required ',
            'detail'=>'required ',
            'tags'=>'required ',
            // 'post_thumb'=>'required | mimes:jpeg,jpg,png,gif',
            // 'cat_id'=>'required ',
            // 'post_image'=>'required | mimes:jpeg,jpg,png,gif',
          ]);
          // $reimage = '';
                      // thumb image
         if($request->hasFile('post_thumb')){
    $image1=$request->file('post_thumb');
    $rethumbImage = time().".".$image1->getClientOriginalExtension();
    $dest1=public_path('/imgs/thumb');
    $image1->move($dest1,$rethumbImage);
}
 else{
    $rethumbImage = 'na';
}
                      // post full  image
         if($request->hasFile('post_image')){

    $image2=$request->file('post_image');
    $refullImage = time().".".$image2->getClientOriginalExtension();
    $dest2=public_path('/imgs/full');
    $image2->move($dest2,$refullImage);
}
else{
    $refullImage = 'na';
}
          $post=new Post;
          $post->user_id = $request->user()->id;
          $post->cat_id = $request->category;
          $post->title=$request->title;
          $post->detail=$request->detail;
          $post->thumb=$rethumbImage;
          $post->full_img=$refullImage;
           $post->tags=$request->tags;
           $post->status=1;
           // $user_id = Auth::id();
           // "user_id"=> Auth::id(),
          $post->save();
        return redirect('save_post_form')->with('success', 'Post has been addedd');
    }

    // manage posts
    function manage_posts(Request $request){
      $posts = Post::where('user_id',$request->user()->id)->orderBy('id', 'desc')->get();
      return view('manage-posts',['posts'=>$posts]);
    }
}
