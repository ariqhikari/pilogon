<?php

namespace App\Http\Controllers;

use App\CoverCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Category_Cover_Course;
use App\Category;
use App\Verifikasi;
use App\Cover_Course_User;
use Illuminate\Support\Facades\Storage;

class CoverCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = CoverCourse::where("user_id",Auth::user()->id)->latest()->paginate(10);
        $verifikasi = Verifikasi::orderBy('updated_at', 'desc')->get();
        return view("public.created_courses.index",compact("courses","verifikasi"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CoverCourse  $coverCourse
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $covercourse = CoverCourse::where("slug",$slug)->first();
        $courses = CoverCourse::where("user_id",Auth::id())->orderBy("title","ASC")->get();
        if (Auth::user()->id != $covercourse->user_id) {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        }
        return view("public.created_courses.show",compact("covercourse","courses"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoverCourse  $coverCourse
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $covercourse = CoverCourse::where("slug",$slug)->first();
        $categorys = Category::get();
        if (Auth::id() != $covercourse->user_id) {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        }
        return view("public.created_courses.edit",compact("covercourse","categorys"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoverCourse  $coverCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cover_course)
    {
        $request->validate([
            "title" => "required",
            "category_id" => "required",
            "description" => "required",
            "thumbnail" => "mimes:png,jpg,jpeg,svg",
            "level" => "required"
        ]);
        $courses = CoverCourse::where("slug",$cover_course)->first();

        $slug = Str::slug($request->title);

        if ($request->thumbnail != null) {
            Storage::disk('public')->delete($courses->thumbnail);
            $file = $request->file('thumbnail')->store('assets/course', 'public');;

            $courses->update([
                "title" => $request->title,
                "slug" => $slug,
                "description" => $request->description,
                "user_id" => Auth::user()->id,
                "level" => $request->level,
                "thumbnail" => $file
            ]);

            $courses->categorys()->sync($request->category_id);

            return redirect()->route("created-course.edit",$courses->slug)->with("sukses","Berhasil Mengupdate Cover Course");
        } else {
            $courses->update([
                "title" => $request->title,
                "slug" => $slug,
                "description" => $request->description,
                "user_id" => Auth::id(),
                "level" => $request->level,
            ]);

            $courses->categorys()->sync($request->category_id);

            return redirect()->route("created-course.index",$courses->slug)->with("sukses","Berhasil Mengupdate Cover Kelas");
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoverCourse  $coverCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoverCourse $coverCourse)
    {
        //
    }

    public function delete(CoverCourse $covercourse){
        if (Auth::user()->id != $covercourse->user_id) {
            return redirect()->back()->with("error","Kamu Tidak Punya Hak Akses");
        }
        $categorys = Category_Cover_Course::where("cover_course_id",$covercourse->id)->get();
        $pendaftar = Cover_Course_User::where("cover_course_id",$covercourse->id)->get();

        foreach ($pendaftar as $key => $value) {
            $value->delete();
        }

        foreach ($categorys as $key => $value) {
            $value->delete();
        }

        foreach ($covercourse->modules as $key2 => $value2) {
            Storage::disk('public')->delete($value2->code);
            $value2->delete();
        }

        Storage::disk('public')->delete($covercourse->thumbnail);

        $covercourse->delete();
        return redirect()->back()->with("sukses","Berhasil Menghapus Kelas Dan Semua Pendaftarnya");
    }
}
