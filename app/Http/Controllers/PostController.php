<?php

namespace App\Http\Controllers;

use App\View;
use App\Post;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where("status",1)->latest()->get()->take(3);
        $categorys = Category::orderBy("name","ASC")->paginate(6);
        return view("public.posts.index",compact("posts","categorys"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::orderBy("name","ASC")->get();
        return view("public.posts.create",compact("categorys"));
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
            "title" => "required|unique:posts,title",
            "category_id" => "required",
            "content" => "required",
            "thumbnail" => "required|mimes:png,jpeg,svg,jpg"
        ]);

        $slug = \Str::slug($request->title);

        $file = $request->file('thumbnail')->store('assets/blog', 'public');

        Post::create([
            "title" => $request->title,
            "category_id" => $request->category_id,
            "content" => $request->content,
            "user_id" => Auth::id(),
            "slug" => $slug,
            "thumbnail" => $file
        ]);

        return redirect()->route("user.artikelku")->with("sukses","Berhasil Membuat Article, Silahkan Publish Article");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $blog)
    {
        $views = View::where("post_id",$blog->id)->where("user_id",Auth::id())->get();
        if ($views->count() == 0) {
            View::create([
                "user_id" => Auth::id(),
                "post_id" => $blog->id
            ]);
        }
        
        $link = \URL::current();
        $recent = Post::where("status", 1)->latest()->get()->take(3);
        return view("public.posts.show",compact("blog","recent","link"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $blog)
    {
        if (Auth::id() != $blog->user_id) {
            return redirect()->back()->with("error","Anda Tidak Punya Hak");
        }

        $categorys = Category::orderBy("name","ASC")->get();
        return view("public.posts.edit",compact("blog","categorys"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $blog)
    {
        $request->validate([
            "title" => "required|unique:posts,title",
            "content" => "required",
            "category_id" => "required",
            "thumbnail" => "required|mimes:png,jpeg,svg,jpg"
        ]);

        $slug = \Str::slug($request->title);

        if ($request->thumbnail == null) {
            $blog->update([
                "title" => $request->title,
                "category_id" => $request->category_id,
                "content" => $request->content,
                "user_id" => Auth::id(),
                "slug" => $slug
            ]);
    
            return redirect()->route("user.artikelku")->with("sukses","Berhasil Mengupdate Article");
        } else {
            Storage::disk('public')->delete($blog->thumbnail);
            $file = $request->file('thumbnail')->store('assets/category', 'public');

            $blog->update([
                "title" => $request->title,
                "category_id" => $request->category_id,
                "content" => $request->content,
                "user_id" => Auth::id(),
                "slug" => $slug,
                "thumbnail" => $file
            ]);
    
            return redirect()->route("user.artikelku")->with("sukses","Berhasil Mengupdate Article ");
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $blog)
    {
        foreach ($blog->comments as $key => $value) {
            $value->delete();
        }

        $blog->delete();
        return redirect()->back()->with("sukses","Berhasil Menghapus Blogs");
    }

    public function delete($id){
        $blog = Post::find($id);
        if ($blog->user_id != Auth::id()) {
            return redirect()->back()->with("error","Anda Tidak Memiliki Hak Akses");
        }
        foreach ($blog->comments as $key => $value) {
            $value->delete();
        }

        $blog->delete();
        return redirect()->back()->with("sukses","Berhasil Menghapus Blogs");
    }

    public function viewMore(){
        $posts = Post::where("status",1)->latest()->paginate(12);
        return view("public.posts.view",compact("posts"));
    }

    public function viewCategory(Category $category){
        $categorys = Post::where("status",1)->where("category_id",$category->id)->latest()->paginate(12);
        return view("public.posts.category",compact("category","categorys"));
    }

    public function user(){
        $posts = Post::where("user_id",Auth::id())->latest()->paginate(12);
        return view("public.posts.user",compact("posts"));
    }

    public function preview(Post $blog){
        if ($blog->user_id != Auth::id()) {
            return redirect()->back()->with("error","Anda Tidak Memiliki Hak Akses");
        }
        
        return view("public.posts.preview",compact("blog"));
    }

    public function upload(Post $blog){
        if ($blog->user_id != Auth::id()) {
            return redirect()->back()->with("error","Anda Tidak Memiliki Hak Akses");
        }

        $blog->update([
            "status" => 1
        ]);

        return redirect()->back()->with("sukses","Berhasil Mengupload Blogs");
    }

    public function draft(Post $blog){
        if ($blog->user_id != Auth::id()) {
            return redirect()->back()->with("error","Anda Tidak Memiliki Hak Akses");
        }

        $blog->update([
            "status" => 0
        ]);

        return redirect()->back()->with("sukses","Berhasil Mendraft Blogs");
    }
}
