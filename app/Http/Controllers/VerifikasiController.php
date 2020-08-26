<?php

namespace App\Http\Controllers;

use App\Verifikasi;
use Illuminate\Http\Request;
use Auth;
use App\CoverCourse;
use App\Cover_Course_User;

class VerifikasiController extends Controller
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
            "cover_course_id" => "required"
        ]);
        
        $course = CoverCourse::find($request->cover_course_id);
        $module = $course->modules->count();

        if ($module == null || $module == 0) {
            return redirect()->back()->with("error","Harap Tambahkan Modul Terlebih Dahulu");
        }

        $verifikasi = Verifikasi::get();
        foreach ($verifikasi as $key => $value) {
            if ($request->cover_course_id == $value->cover_course_id && $value->status == 0) {
                return redirect()->back()->with("error","Course Sudah Ada Dalam Antrian");
            }
        }

        Verifikasi::create([
            "cover_course_id" => $request->cover_course_id,
            "status" => 0
        ]);

        return redirect()->back()->with("sukses","Berhasil Memverfikasi Course, Tunggu Tanggapan Admin ya");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Verifikasi $verifikasi)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Verifikasi $verifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verifikasi $verifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verifikasi $verifikasi)
    {
        //
    }

    public function deleteRiwayat(){
        $courses = CoverCourse::where("user_id",Auth::id())->get();
        $verifikasi_data = Verifikasi::get();

        foreach ($courses as $key => $value) {
            foreach ($verifikasi_data as $key2 => $value2) {
                if($value->id == $value2->cover_course_id){
                    $value2->delete();
                }
            }
        }

        return redirect()->back()->with("sukses","Berhasil Menghapus Riwayat");
    }

    public function drop(Request $request){
        $request->validate([
            "cover_course_id" => "required"
        ]);
        
        $course = CoverCourse::where("id",$request->cover_course_id)->first();
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

        return redirect()->back()->with("sukses","Berhasil Menarik Kembali Course");
    }
}
