<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post_Comment;
use App\Post;
use Auth;

class Post_CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            "comment" => "required"
        ]);

        Post_Comment::create([
            "user_id" => Auth::id(),
            "post_id" => $request->blog_id,
            "comment" => $request->comment
        ]);

        return redirect()->back()->with('sukses',"Berhasil Memberi Komentar");
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

    public function balas($id,Post $blog){
        $parent = Post_Comment::find($id);
        $recent = Post::latest()->get()->take(3);
        $link = \URL::current();
        return view("public.posts.show",compact("blog","parent","recent","link"));
    }

    public function storeBalasan(Request $request){
        $blog = Post::find($request->blog_id);
        Post_Comment::create([
            "user_id" => Auth::id(),
            "post_id" => $request->blog_id,
            "parent" => $request->parent_id,
            "comment" => $request->comment
        ]);
        $link = \URL::current();

        return redirect()->route("blogs.show",$blog)->with("sukses","Berhasil Membalas Komentar","link");
    }
}
