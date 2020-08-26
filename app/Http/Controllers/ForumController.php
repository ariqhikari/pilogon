<?php

namespace App\Http\Controllers;

use App\Forum;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use App\Category_Forum;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $forums = Forum::latest()->paginate(18);
        $likes_me = [];
        foreach (Auth::user()->like_forums as $key => $value) {
            $likes_me[] = $value->forum_id;
        }
        return view("public.forums.index",compact("forums","likes_me"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::orderBy("name","ASC")->get();
        return view("public.forums.create",compact("categorys"));
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
            "title" => "required",
            "question" => "required",
            "category_id" => "required"
        ]);

        $slug = \Str::slug($request->title."-".\Str::random(5));

        $forum = Forum::create([
            "title" => $request->title,
            "problem" => $request->question,
            "user_id" => Auth::id(),
            "slug" => $slug
        ]);

        $forum->categorys()->attach($request->category_id);
        return redirect()->route("forum.user")->with("sukses","Berhasil Membuat Pertanyaan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        $likes_me = [];
        foreach (Auth::user()->like_forums as $key => $value) {
            $likes_me[] = $value->forum_id;
        }
        $recent = Forum::latest()->get()->take(16);
        $link = \URL::current();

        return view("public.forums.show",compact("forum","recent","likes_me","link"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        if($forum->user_id != Auth::id()){
            return redirect()->back()->with("error","Kamu Tidak Punya Hak Akses");
        }
        $categorys = Category::orderBy("name","ASC")->get();
        return view("public.forums.edit",compact("forum","categorys"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        $request->validate([
            "title" => "required",
            "question" => "required",
            "category_id" => "required"
        ]);

        $slug = \Str::slug($request->title."-".\Str::random(5));

        $forum->update([
            "title" => $request->title,
            "problem" => $request->question,
            "slug" => $slug
        ]);

        $forum->categorys()->sync($request->category_id);

        return redirect()->route("forum.user")->with("sukses","Berhasil Mengedit Pertanyaan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        foreach ($forum->comments as $key => $value) {
            $value->delete();
        }

        foreach ($forum->likes as $key => $value) {
            $value->delete();
        }

        $forum->delete();
        return redirect()->back()->with("sukses","Berhasil Menghapus Pertanyaan");
    }

    public function user(){
        $forums = Forum::where("user_id",Auth::id())->latest()->paginate(10);
        return view("public.forums.user",compact("forums"));
    }
    
    public function delete(Forum $forum){
        if($forum->user_id != Auth::id()){
            return redirect()->back()->with("error","Kamu Tidak Punya Hak Akses");
        }

        $categorys = Category_Forum::where("forum_id",$forum->id)->get();

        foreach ($categorys as $key => $value) {
            $value->delete();
        }

        foreach ($forum->comments as $key => $value) {
            $value->delete();
        }

        foreach ($forum->likes as $key => $value) {
            $value->delete();
        }
        
        $forum->delete();
        return redirect()->route("forum.user")->with("sukses","Berhasil Menghapus Pertanyaan");
    }

    public function search(Request $request){
        $request->validate([
            "keyword" => "required"
        ]);

        $forums = Forum::where("title",$request->keyword)->orWhere("title","like","%".$request->keyword."%")->latest()->paginate(18);
        $likes_me = [];
        foreach (Auth::user()->like_forums as $key => $value) {
            $likes_me[] = $value->forum_id;
        }   
        return view("public.forums.index",compact("forums","likes_me"));
    }
}
