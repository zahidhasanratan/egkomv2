<?php

namespace App\Http\Controllers\Admin;

use App\Models\BigAdvertise;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Str;

class BigAdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders =   BigAdvertise::all();
        return view('admin.bigadvertise.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bigadvertise.create');
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
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = \Illuminate\Support\Str::slug($request->title);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/bigadvertise'))
            {
                mkdir('uploads/bigadvertise', 0777 , true);
            }
            $image->move('uploads/bigadvertise',$imagename);
        }else {
            $imagename = 'dafault.png';
        }

        $slider = new BigAdvertise();
        $slider->title = $request->title;
        $slider->url = $request->url;
        $slider->image = $imagename;
        $slider->save();
        return redirect()->route('bigadvertise.index')->with('successMsg','Advertise Successfully Saved');

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
        $slider =   BigAdvertise::find($id);
        return view('admin/bigadvertise/edit',compact('slider'));
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
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = \Illuminate\Support\Str::slug($request->title);
        $slider = BigAdvertise::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/bigadvertise'))
            {
                mkdir('uploads/bigadvertise', 0777 , true);
            }
            $image->move('uploads/bigadvertise',$imagename);
        }else {
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->url = $request->url;
        $slider->image = $imagename;
        $slider->save();
        return redirect()->route('bigadvertise.index')->with('successMsg','Advertise Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = BigAdvertise::find($id);
        if (file_exists('uploads/bigadvertise/'.$slider->image))
        {
            unlink('uploads/bigadvertise/'.$slider->image);
        }
        $slider->delete();
        return redirect()->back()->with('successMsg','Advertise Successfully Deleted');
    }
}
