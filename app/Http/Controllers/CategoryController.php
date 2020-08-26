<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->permission != "admin") {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        }
        $categorys = Category::orderBy("name","ASC")->latest()->paginate(10);
        return view("admin.categorys.index",compact("categorys"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->permission != "admin") {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        }
        return view("admin.categorys.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "gambar" => "required|mimes:png,jpg,jpeg,svg"
        ]);

        $slug = \Str::slug($request->name."-".\Str::random(5));

        $file = $request->file('gambar')->store('assets/category', 'public');

        Category::create([
            "name" => $request->name,
            "slug" => $slug,
            "gambar" => $file
        ]);

        return redirect()->route("categorys.index")->with("success","Success Created Category");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::user()->permission != "admin") {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        }
        return view("admin.categorys.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => "required"
        ]);

        $slug = \Str::slug($request->name."-".\Str::random(5));

        if ($request->gambar == null) {
            $category->update([
                "name" => $request->name,
                "slug" => $slug
            ]);
    
            return redirect()->route("categorys.index")->with("success","Success Edited Category");
        } else{
            Storage::disk('public')->delete($category->gambar);
            $file = $request->file('gambar')->store('assets/category', 'public');

            $category->update([
                "name" => $request->name,
                "slug" => $slug,
                "gambar" => $file
            ]);
    
            return redirect()->route("categorys.index")->with("success","Success Edited Category");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::disk('public')->delete($category->gambar);
        $category->delete();
        return redirect()->route("categorys.index")->with("success","Success Deleted Category");
    }

    public function search(Request $request){
        if (Auth::user()->permission != "admin") {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        }
        $categorys = Category::where("name",$request->keyword)->orWhere("name","like","%".$request->keyword."%")->latest()->paginate(10);
        return view("admin.categorys.index",compact("categorys"));
    }
}
