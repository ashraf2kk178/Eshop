<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
// use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $data = Post::all();
       return view('backend.post.index',[
        'data'=>$data,
    ]);
                   // count comment

                 // end count comments

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();
        return view('backend.post.create', ['cats'=> $cats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
          $post->user_id = 0;
          $post->cat_id = $request->category;
          $post->title=$request->title;
          $post->detail=$request->detail;
          $post->thumb=$rethumbImage;
          $post->full_img=$refullImage;
           $post->tags=$request->tags;
           // $user_id = Auth::id();
           // "user_id"=> Auth::id(),
          $post->save();

        return redirect('admin/post/create')->with('success', 'data has been addedd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $cats= Category::all();
          $data= Post::find($id);

        return view('backend.post.update', ['data' => $data, 'cats' => $cats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[

              'title'=>'required | max:200',
            'category'=>'required ',
            'detail'=>'required ',
            'tags'=>'required ',
            // 'thumb'=>'required ',
            // // 'cat_id'=>'required ',
            // 'full_img'=>'required ',

          ]);
          // $reimage = '';

                      // thumb image
         if($request->hasFile('post_thumb')){

    $image1=$request->file('post_thumb');
    $rethumbImage = time().".".$image1->getClientOriginalExtension();
    $dest1=public_path('/imgs/thumb');
    $image1->move($dest1,$rethumbImage);
} else{
    $rethumbImage = $request->post_thumb;
}


                      // post full  image
         if($request->hasFile('post_image')){

    $image2=$request->file('post_image');
    $refullImage = time().".".$image2->getClientOriginalExtension();
    $dest2=public_path('/imgs/full');
    $image2->move($dest2,$refullImage);
} else{
    $refullImage = $request->post_thumb;
}
          $post = Post::find($id);
          $post->user_id = 0;
          $post->cat_id = $request->category;
          $post->title=$request->title;
          $post->detail=$request->detail;
          $post->thumb=$rethumbImage;
          $post->full_img=$refullImage;
           $post->tags=$request->tags;
           // $user_id = Auth::id();
           // "user_id"=> Auth::id(),
          $post->update();

        return redirect('admin/post/create')->with('success', 'data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id',$id)->delete();
            return redirect('admin/post');
    }
}
