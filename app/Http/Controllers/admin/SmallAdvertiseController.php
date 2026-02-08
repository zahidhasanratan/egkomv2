<?php

namespace App\Http\Controllers\admin;


use App\Models\SmallAdvertise;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Str;

class SmallAdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders =   SmallAdvertise::all();
        return view('admin.smalladvertise.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.smalladvertise.create');
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
            if (!file_exists('uploads/smalladvertise'))
            {
                mkdir('uploads/smalladvertise', 0777 , true);
            }
            $image->move('uploads/smalladvertise',$imagename);
        }else {
            $imagename = 'dafault.png';
        }

        $slider = new SmallAdvertise();
        $slider->title = $request->title;
        $slider->url = $request->url;
        $slider->image = $imagename;
        $slider->save();
        return redirect()->route('smalladvertise.index')->with('successMsg','Advertise Successfully Saved');

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
        $slider =   SmallAdvertise::find($id);
        return view('admin/smalladvertise/edit',compact('slider'));
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
        $slider = SmallAdvertise::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/smalladvertise'))
            {
                mkdir('uploads/smalladvertise', 0777 , true);
            }
            $image->move('uploads/smalladvertise',$imagename);
        }else {
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->url = $request->url;
        $slider->image = $imagename;
        $slider->save();
        return redirect()->route('smalladvertise.index')->with('successMsg','Advertise Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = SmallAdvertise::find($id);
        if (file_exists('uploads/smalladvertise/'.$slider->image))
        {
            unlink('uploads/smalladvertise/'.$slider->image);
        }
        $slider->delete();
        return redirect()->back()->with('successMsg','Advertise Successfully Deleted');
    }
}
