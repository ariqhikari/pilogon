<?php

namespace App\Http\Controllers;

use App\Comment_Forum;
use App\Forum;
use Illuminate\Http\Request;
use Auth;

class CommentForumController extends Controller
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
            "jawaban" => "required"
        ]);

        Comment_Forum::create([
            "user_id" => Auth::id(),
            "forum_id" => $request->forum_id,
            "comment" => $request->jawaban
        ]);

        return redirect()->back()->with("sukses","Berhasil Memberi Jawaban");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment_Forum  $comment_Forum
     * @return \Illuminate\Http\Response
     */
    public function show(Comment_Forum $comment_Forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment_Forum  $comment_Forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment_Forum $comment_Forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment_Forum  $comment_Forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment_Forum $comment_Forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment_Forum  $comment_Forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment_Forum $comment_Forum)
    {
        //
    }

    public function balas(Forum $forum, $id){
        $parent = Comment_Forum::find($id);
        $likes_me = [];
        foreach (Auth::user()->like_forums as $key => $value) {
            $likes_me[] = $value->forum_id;
        }
        $link = \URL::current();
        $recent = Forum::latest()->get()->take(16);
        return view("public.forums.show",compact("forum","recent","likes_me","parent","link"));
    }

    public function storeBalasan(Request $request){
        $request->validate([
            "jawaban" => "required"
        ]);

        Comment_Forum::create([
            "user_id" => Auth::id(),
            "forum_id" => $request->forum_id,
            "comment" => $request->jawaban,
            "parent" => $request->parent_id
        ]);
        
        $forum = Forum::find($request->forum_id);

        return redirect()->route("forum.show",$forum)->with("sukses","Berhasil Memberi Jawaban");
    }
}
