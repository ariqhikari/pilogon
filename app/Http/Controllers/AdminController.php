<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\CoverCourse;
use App\Verifikasi;
use App\Cover_Course_User;
use App\Forum;
use App\Post;

class AdminController extends Controller
{
    public function dashboard(){
        $courses = CoverCourse::get()->count();
        $verifikasi = Verifikasi::where("status",0)->latest()->paginate(10);
        return view("admin.dashboard",compact("courses","verifikasi"));
    }

    public function userIndex(){
        $users = User::orderBy("name","ASC")->latest()->paginate(10);
        return view("admin.users.index",compact("users"));
    }

    public function userSearch(Request $request){
        $users = User::where("name",$request->keyword)->orWhere("name","like","%".$request->keyword."%")->latest()->paginate(10);
        return view("admin.users.index",compact("users"));
    }

    public function upload($id){
        if (Auth::user()->permission != 'admin') {
            return redirect()->back()->with("error","you doens't have permission");
        }
        $verifikasi = Verifikasi::find($id);
        $course = CoverCourse::find($verifikasi->cover_course_id);
        $verifikasi->update([
            "status" => 2
        ]);
        $course->update([
            "status" => 2
        ]);

        return redirect()->back()->with("sukses","Berhasil Mengupload Course");
    }
    
    public function tolak($id){
        $verifikasi = Verifikasi::find($id);
        $verifikasi->update([
            "status" => 1
            ]);
            
            return redirect()->back()->with("sukses","Berhasil Menolak Course");
        }

    public function courseIndex(){
        $courses = CoverCourse::where("status",2)->latest()->paginate(10);
        return view("admin.courses.index",compact("courses"));
    }

    public function drop($id){
        $course = CoverCourse::where("slug",$id)->first();
        $pendaftar = Cover_Course_User::where("cover_course_id",$course->id)->get();
        Verifikasi::create([
            "cover_course_id" => $course->id,
            "status" => 3
        ]);

        foreach ($pendaftar as $key => $value) {
            $value->delete();
        }
        $course->update([
            "status" => 0
        ]);

        return redirect()->back()->with("sukses","Berhasil Mendrop Course");
    }

    public function forumIndex(){
        $forums = Forum::orderBy("title","ASC")->latest()->paginate(10);
        return view("admin.forums.index",compact("forums"));
    }

    public function blogIndex(){
        $blogs = Post::orderBy("title","ASC")->latest()->paginate(10);
        return view("admin.blogs.index",compact("blogs"));
    }
}


