<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Category::all();
       return view('backend.category.index',['data'=>$data, 
        'title'=>'All Categories',
         'meta_desc' => 'this is meta description for all categories'
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'detail'=>'required | max:2500',
            //  'cat_image' => 'required | mimes:jpeg,jpg,png,gif',
              'cat_image'=>'required ',
          ]);
          // $reimage = '';

         if($request->hasFile('cat_image')){

    $image=$request->file('cat_image');
    $reImage = time().".".$image->getClientOriginalExtension();
    $dest=public_path('/imgs');
    $image->move($dest,$reImage);
}
          $category=new Category;
          $category->title=$request->title;
          $category->detail=$request->detail;
          $category->image=$reImage;
          $category->save();

          return redirect('admin/category/create')->with('success', 'data has been addedd');

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
              $data= Category::find($id);
               return view('backend.category.update', ['data' => $data]);

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
        //
        $this->validate($request,[

            'title'=>'required | max:200',
            'detail'=>'required | max:2500',
            //  'cat_image' => 'required | mimes:jpeg,jpg,png,gif',
              'cat_image'=>'required ',
          ]);
          // $reimage = '';

      
   if($request->hasFile('cat_image')){
  
      $image = $request->file('cat_image');
      $reImage = time().'.'. $image->getClientOriginalExtension();
      $dest = public_path('/imgs');
      $image->move($dest,$reImage);
  }
  else{
    $reImage = $request->cat_image;
  }
   $category = Category :: find($id);
   $category->title = $request->title;
   $category->detail= $request->detail;
   $category->image = $reImage;
   $category->update();
   return redirect('admin/category/'.$id.'/edit')->with('success','Data has been update');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       Category::where('id',$id)->delete();
            return redirect('admin/category');
    }
}
