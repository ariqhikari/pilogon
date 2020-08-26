<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\CoverCourse;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
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
            "title" => "required",
            "materi" => "required",
            "code" => "mimes:zip"
        ]);

        if ($request->code == null) {
            $covercourse = CoverCourse::where("slug",$request->slug)->first();
            Course::create([
                "title" => $request->title,
                "materi" => $request->materi,
                "cover_course_id" => $covercourse->id,
                "user_id" => Auth::user()->id
            ]);

            return redirect()->route("created-course.show",$request->slug)->with("sukses","Berhasil Menambahkan Module");
        } else{
            $code = $request->file('code')->store('assets/course/module/code', 'public');
            
            $covercourse = CoverCourse::where("slug",$request->slug)->first();

            Course::create([
                "title" => $request->title,
                "materi" => $request->materi,
                "cover_course_id" => $covercourse->id,
                "code" => $code,
                "user_id" => Auth::id()
            ]);

            return redirect()->route("created-course.show",$request->slug)->with("sukses","Berhasil Menambahkan Module");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $covercourse = CoverCourse::where("slug",$slug)->first();
        if (Auth::id() != $covercourse->user_id && Auth::user()->permission != "admin") {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        } if(Auth::id() == $covercourse->user_id || Auth::user()->permission == "admin"){
            $module = Course::find($id);
            $index;
            foreach ($covercourse->modules as $key => $value) {
                if ($value->id == $module->id) {
                    $index = $key;
                }
            }
            $daftar_module = $covercourse->modules;
            return view("public.created_courses.preview",compact("covercourse","module","daftar_module","index"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $slug)
    {
        $course_update = Course::find($id);
        $covercourse = CoverCourse::where("slug",$slug)->first();
        $courses = CoverCourse::where("user_id",Auth::id())->orderBy("title","ASC")->get();
        if (Auth::id() != $covercourse->user_id && $course_update->user_id != Auth::id()) {
            return redirect()->back()->with("error","You Doesn't Have Permission");
        }
        return view("public.created_courses.show",compact("covercourse","courses","course_update"));
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
        $request->validate([
            "title" => "required",
            "materi" => "required",
            "code" => "mimes:zip"
        ]);

        $course_update = Course::find($id);
        $covercourse = CoverCourse::where("slug",$request->slug)->first();

        if ($request->code == null) {
            $course_update->update([
                "title" => $request->title,
                "materi" => $request->materi,
                "cover_course_id" => $covercourse->id,
            ]);

            return redirect()->route("created-course.show",$request->slug)->with("sukses","Berhasil Mengupdate Module");
        } else{
            Storage::disk('public')->delete($covercourse->code);
            $code = $request->file('code')->store('assets/course/module/code', 'public');
            
            $covercourse = CoverCourse::where("slug",$request->slug)->first();

            $course_update->update([
                "title" => $request->title,
                "materi" => $request->materi,
                "cover_course_id" => $covercourse->id,
                "code" => $code
            ]);

            return redirect()->route("created-course.show",$request->slug)->with("sukses","Berhasil Mengupdate Module");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Course::findOrFail($id);
            if ($module->user_id != Auth::id()) {
                return redirect()->back("error","Kamu Tidak Punya Hak Akses");
            }
        Storage::disk('public')->delete($module->code);
        $module->delete();
        return redirect()->back()->with("sukses","Berhasil Menghapus Module");
    }

    public function download($id){
        $module = Course::findOrFail($id);

        return Storage::disk('public')->download($module->code, Str::slug($module->title) . '-source-code.zip');
    }
}
