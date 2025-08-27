<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);

        $images2 = [];

        foreach ($request->file('images2') as $image2) {
            $imageName = time() . '_' . $image2->getClientOriginalName();
            $image2->move(public_path('images'), $imageName);
            $images2[] = $imageName;
        }
        $imagesString = implode(',', $images2);

        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/category'))
            {
                mkdir('uploads/category', 0777 , true);
            }
            $image->move('uploads/category',$imagename);
        }else {
            $imagename = 'dafault.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = str_slug($request->name);
        $category->image = $imagename;
        $category->images2 = $imagesString;
        $category->save();
        return redirect()->route('category.index')->with('successMsg','Category Successfully Saved');
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
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
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
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/category'))
            {
                mkdir('uploads/category', 0777 , true);
            }
            $image->move('uploads/category',$imagename);
        }else {
            $imagename = $category->image;
        }

        // Upload new images
        if ($request->hasFile('images2')) {
            $images2 = $request->file('images2');
            $imageNames2 = [];
            foreach ($images2 as $image2) {
                $imageName2 = $image2->getClientOriginalName();
                $image2->move(public_path('images'), $imageName2);
                $imageNames2[] = $imageName2;
            }
            $category->images2 = implode(',', $imageNames2);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $slug;
        $category->image = $imagename;

        if ($request->has('deleted_images')) {
            $deletedImages = $request->input('deleted_images');
            foreach ($deletedImages as $image2) {
                $imagePath = public_path('images/' . $image2);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                else{

                }
            }
            $category->images2 = implode(',', array_diff(explode(',', $category->images2), $deletedImages));
        }

        $category->save();
        return redirect()->route('category.index')->with('successMsg','Category Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id);
        if (file_exists('uploads/category/'.$categories->image))
        {
            unlink('uploads/category/'.$categories->image);
        }
        $categories->delete();
        return redirect()->back()->with('successMsg','Category Successfully Deleted');
    }
}
