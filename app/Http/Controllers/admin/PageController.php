<?php

namespace App\Http\Controllers\admin;

use App\Objects;
use App\Page;
use Carbon\Carbon;
use App\Menu;
use App\Others;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page =   Page::all();
        return view('admin.page.index',compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_all   =   Menu::all();
        return view('admin.page.create',compact('menu_all'));
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
            'title_uri' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = $request->title_uri;
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/page'))
            {
                mkdir('uploads/page', 0777 , true);
            }
            $image->move('uploads/page',$imagename);
        }else {
            $imagename = '';
        }

        $page = new Page();
        $page->title = $request->title;
        $page->sub_title = $request->sub_title;
        $page->title_uri = $slug;
        $page->short = $request->short;
        $page->description = $request->description;
        $page->image = $imagename;
        $page->save();
        return redirect()->route('page.index')->with('successMsg','Page Successfully Saved');

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
        $page =   Page::find($id);
        $menu_all   =   Menu::all();

        $parent_root_id = Page::orderBy('id','DESC')
            ->where('title_uri',$page->title_uri)->first();
        $parent_id_for = Menu::orderBy('id','DESC')
            ->where('slug',$parent_root_id->title_uri)->first();

        return view('admin/page/edit',compact('page','menu_all','parent_id_for'));
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
            'title_uri' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = $request->title_uri;
        $page = Page::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/page'))
            {
                mkdir('uploads/page', 0777 , true);
            }
            $image->move('uploads/page',$imagename);
        }else {
            $imagename = $page->image;
        }

        $page->title = $request->title;
        $page->sub_title = $request->sub_title;
        $page->title_uri = $slug;
        $page->short = $request->short;
        $page->description = $request->description;
        $page->image = $imagename;
        $page->save();
        return redirect()->route('page.index')->with('successMsg','Page Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $page = Page::find($id);
        if (file_exists('uploads/page/'.$page->image))
        {
            unlink('uploads/page/'.$page->image);
        }
        $page->delete();
        return redirect()->back()->with('successMsg','Page Successfully Deleted');
    }

    public function details($slug){
        $page = Page::where('title_uri',$slug)->first();



        $main   =   Menu::orderBy('sequence','ASC')
            ->where('display',1)
            ->get();


        return view('frontend/page.details',compact('page','main'));
    }
}
