<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $setting = Setting::first();
           return view('backend.setting.index', ['setting'=> $setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            'comment_auto'=>'required | max:200',
            'user_auto'=>'required ',
            'recent_limit'=>'required ',
            'popular_limit'=>'required ',
            'recent_comment_limit'=>'required ',

          ]);
          $countData=Setting::count();
          if ($countData == 0) {
          $data=new Setting;
          $data->comment_auto=$request->comment_auto;
          $data->user_auto=$request->user_auto;
          $data->recent_limit=$request->recent_limit;
          $data->popular_limit=$request->popular_limit;
          $data->recent_comment_limit=$request->recent_comment_limit;
          $data->save();
           }else{
            $firstData = Setting::first();
            $data = Setting::find($firstData->id);
            $data=new Setting;
          $data->comment_auto=$request->comment_auto;
          $data->user_auto=$request->user_auto;
          $data->recent_limit=$request->recent_limit;
          $data->popular_limit=$request->popular_limit;
          $data->recent_comment_limit=$request->recent_comment_limit;
          $data->save();
           }

 return redirect('admin/setting')->with('success', 'data has been updated');
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
        //
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
    }
}
