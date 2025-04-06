<?php

namespace App\Http\Controllers\admin;

use App\Others;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OthersController extends Controller
{
    public function index()
    {
        $others   =   Others::all();
        return view('admin.others.index',compact('others'));
        //
    }

    public function edit($id)
    {
        $others =   Others::find($id);
        return view('admin/others/edit',compact('others'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',

        ]);


        $page = Others::find($id);

        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->phone = $request->phone;

        $page->description = $request->description;

        $page->save();
        return redirect()->route('others.index')->with('successMsg','Successfully Updated');
    }

}
