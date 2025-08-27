<?php

namespace App\Http\Controllers\admin;

use App\video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video =   video::all();
        return view('admin.video.index',compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
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
            'title' => 'required',
            'video' => 'required',
        ]);




        $video = new video();
        $video->title = $request->title;
        $video->video = $request->video;

        $video->save();
        return redirect()->route('video.index')->with('successMsg','Video Successfully Saved');

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
        $video =   video::find($id);
        return view('admin/video/edit',compact('video'));
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
            'title' => 'required',
            'video' => 'required',
        ]);


        $video = video::find($id);


        $video->title = $request->title;
        $video->video = $request->video;
        $video->save();
        return redirect()->route('video.index')->with('successMsg','Video Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = video::find($id);
        if (file_exists('uploads/video/'.$video->image))
        {
            unlink('uploads/video/'.$video->image);
        }
        $video->delete();
        return redirect()->back()->with('successMsg','Video Successfully Deleted');
    }
}
