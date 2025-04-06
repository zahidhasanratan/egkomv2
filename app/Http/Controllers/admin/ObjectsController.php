<?php

namespace App\Http\Controllers\admin;

use App\Menu;
use App\Objects;
use App\Others;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ObjectsController extends Controller
{
    public function index()
    {
        $objects   =   Objects::all();
        return view('admin.objects.index',compact('objects'));
        //
    }

    public function edit($id)
    {
        $objects =   Objects::find($id);
        return view('admin/objects/edit',compact('objects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = $request->slug;

        $page = Objects::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/object'))
            {
                mkdir('uploads/object', 0777 , true);
            }
            $image->move('uploads/object',$imagename);
        }else {
            $imagename = $page->image;
        }

        $page->title = $request->title;
        $slug = str_slug($request->title);

        $page->short = $request->short;
        $page->slug = $slug;
        $page->description = $request->description;
        $page->image = $imagename;
        $page->save();
//        return redirect()->route('objects.index')->with('successMsg','Successfully Updated');
        return redirect()->route('objects.edit',$page->id)->with('successMsg','Successfully Updated');

    }
    public function details($slug){
        $page = Objects::where('slug',$slug)->first();

        $main   =   Menu::orderBy('sequence','ASC')
            ->where('display',1)
            ->get();
        $footer   =   Menu::orderBy('sequence','ASC')
            ->where('footer1',1)
            ->get();

        $objects  =   Objects::orderBy('id','ASC')
            ->where('id',1)
            ->get();
        $contact1  =   Others::orderBy('id','ASC')
            ->where('id',2)
            ->get();
        $contact2  =   Others::orderBy('id','ASC')
            ->where('id',3)
            ->get();
        $headoffice  =   Others::orderBy('id','ASC')
            ->where('id',4)
            ->get();

        return view('frontend/objects.details',compact('page','main','footer','objects','contact1','contact2','headoffice'));
    }
}
