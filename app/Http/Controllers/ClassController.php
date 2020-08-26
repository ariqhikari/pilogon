<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\CoverCourse;
use App\Category;
use App\Course;
use App\Cover_Course_User;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    public function index(){
        $courses = CoverCourse::where("status",2)->latest()->paginate(18);
        return view("public.class.index",compact("courses"));
    }

    public function create_cover(){
        $categorys = Category::orderBy("name","ASC")->latest()->get();
        return view("public.class.create_cover",compact("categorys"));
    }

    public function store_cover(Request $request){
        $request->validate([
            "title" => "required",
            "category_id" => "required",
            "thumbnail" => "required|mimes:png,jpg,jpeg,svg",
            "description" => "required",
            "level" => "required"
        ]);

        $slug = Str::slug($request->title."-".\Str::random(5));

        $file = $request->file('thumbnail')->store('assets/course', 'public');

        $cover = CoverCourse::create([
            "title" => $request->title,
            "slug" => $slug,
            "description" => $request->description,
            "user_id" => Auth::id(),
            "level" => $request->level,
            "thumbnail" => $file
        ]);

        $cover->categorys()->attach($request->category_id);

        return redirect()->route("created-course.index")->with("sukses","Sukses Membuat Cover Kelas");
    }

    public function search_cover(Request $request){
        $courses = CoverCourse::where("title",$request->keyword)->orWhere("title","like","%".$request->keyword."%")->where("status",2)->latest()->paginate(18);
        return view("public.class.index",compact("courses"));
    }

    public function image(Request $request){
        if ($request->hasFile('upload')) {
            $ckeditor = $request->input('CKEditorFuncNum');
            $url = Storage::url($request->file('upload')->store('assets/ckeditor', 'public'));
            $msg = 'Image uploaded successfully'; 

            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";
    
            @header('Content-type: text/html; charset=utf-8'); 
            return $response;
        }  
    }

    public function show(CoverCourse $slug){
        $covercourse = $slug;
        $data_course = [];
        foreach (Auth::user()->course_registered as $key => $value) {
            $data_course[] = $value->id;
        }

        return view("public.class.show",compact("covercourse","data_course"));
    }

    public function daftar($slug){
        $courses = CoverCourse::where("slug",$slug)->first();
        foreach (Auth::user()->course_registered as $key => $value) {
            if ($value->id == $courses->id) {
                return redirect()->back()->with("error","Kamu Sudah Terdaftar Dikelas ini");
            }
        }
        Auth::user()->course_registered()->attach($courses->id);
        return redirect()->back()->with("sukses","Anda Sudah Mendaftar Dikelas Ini, Selamat Belajar");
    }

    public function belajar($slug, $id){
        $module = Course::find($id);
        $covercourse = CoverCourse::where("slug",$slug)->first();
        $cu = Cover_Course_User::get();
        $data_course_user = [];

        foreach (Auth::user()->course_registered as $key4 => $value4) {
            $data_course_user[] = $value4->id;
        }

        if (!\in_array($covercourse->id,$data_course_user)) {
            return redirect()->back()->with("error","Anda Tidak Memiliki Izin");
        }

        $daftar_module = $covercourse->modules;
        foreach ($covercourse->modules as $key => $value) {
            if ($module->id == $value->id) {
                $index = $key;
            }
        }

        foreach ($cu as $key3 => $value3) {
            if ($value3->user_id == Auth::id() && $value3->cover_course_id == $covercourse->id) {
                $value3->update([
                    "index" => $index
                ]);
            }
        }

        return view("public.class.tutorial",compact("module","covercourse","daftar_module","index"));
    }

    public function filter(Request $request){
        $courses = CoverCourse::where("status",2)->where("level",$request->level)->latest()->paginate(18);
        return view("public.class.index",compact("courses"));
    }

}