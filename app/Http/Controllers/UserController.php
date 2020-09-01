<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\User;
use Auth;
use App\Profile;
use App\CoverCourse;
use App\Cover_Course_User;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("public.user.show",compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->slug != $user->slug){
            return redirect()->back()->with("error","Kamu Tidak Punya Hak Akses");
        }
        return view("public.user.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user){
        $request->validate([
            "name" => "required",
            "foto" => "mimes:png,jpg,jpeg,svg"
        ]);
        
        $slug = Str::slug($request->name."-".\Str::random(5));

        if($request->foto == null && $request->password == null){
            
            $user->update([
                "name" => $request->name,
                "slug" => \Str::slug($slug)
            ]);
                
            $profile = Profile::where("user_id",$user->id)->first();
            $profile->update([
                "no_telepon" => $request->telepon,
                "kota" => $request->kota,
                "biodata" => $request->biodata,
                "jenis_kelamin" => $request->kelamin,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal" => $request->tanggal_lahir,
                "asal_sekolah" => $request->asal_sekolah,
                "skill" => $request->skill,
                "instagram" => $request->instagram,
                "github" => $request->github,
                "facebook" => $request->facebook
            ]);

            return redirect()->route("user.edit",$user)->with("sukses",'Berhasil Edit Profile');
        } else if($request->foto == null){
            $user->update([
                "name" => $request->name,
                "password" => bcrypt($request->password),
                "slug" => \Str::slug($slug)
            ]);
                
            $profile = Profile::where("user_id",$user->id)->first();
            $profile->update([
                "no_telepon" => $request->telepon,
                "kota" => $request->kota,
                "biodata" => $request->biodata,
                "jenis_kelamin" => $request->kelamin,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "asal_sekolah" => $request->asal_sekolah,
                "skill" => $request->skill,
                "instagram" => $request->instagram,
                "github" => $request->github,
                "facebook" => $request->facebook
            ]);
            return redirect()->route("user.edit",$user)->with("sukses",'Berhasil Edit Profile');
        } else if($request->password == null){
            if(!Str::contains($user->foto, 'avatar')){
                Storage::disk('public')->delete($user->foto);
            }

            $file = $request->file('foto')->store('assets/profile', 'public');

            $user->update([
                "name" => $request->name,
                "foto" => $file,
                "slug" => \Str::slug($slug)
            ]);
                
            $profile = Profile::where("user_id",$user->id)->first();
            $profile->update([
                "no_telepon" => $request->telepon,
                "kota" => $request->kota,
                "biodata" => $request->biodata,
                "jenis_kelamin" => $request->kelamin,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "asal_sekolah" => $request->asal_sekolah,
                "skill" => $request->skill,
                "instagram" => $request->instagram,
                "github" => $request->github,
                "facebook" => $request->facebook
            ]);

            return redirect()->route("user.edit",$user)->with("sukses",'Berhasil Edit Profile');
        } else{
            $file = $request->file('foto')->store('assets/profile', 'public');

            $user->update([
                "name" => $request->name,
                "foto" => $file,
                "password" => bcrypt($request->password),
                "slug" => \Str::slug($slug)
                ]);
                
            $profile = Profile::where("user_id",$user->id)->first();
            $profile->update([
                "no_telepon" => $request->telepon,
                "kota" => $request->kota,
                "biodata" => $request->biodata,
                "jenis_kelamin" => $request->kelamin,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "asal_sekolah" => $request->asal_sekolah,
                "skill" => $request->skill,
                "instagram" => $request->instagram,
                "github" => $request->github,
                "facebook" => $request->facebook
            ]);

            return redirect()->route("user.edit",$user)->with("sukses",'Berhasil Edit Profile');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $profiles = Profile::where("user_id",$user->id)->get();
        foreach($profiles as $item){

            $item->delete();
        }
        
        if(!Str::contains($user->foto, 'avatar')){
            Storage::disk('public')->delete($user->foto);
        }
        $user->delete();
        return redirect()->back()->with("sukses",'Berhasil Hapus User');
    }

    public function learned_course(){
        $courses = Cover_Course_User::where("user_id",Auth::id())->latest()->paginate(12);
        return view("public.user.learned",compact("courses"));
    }

    public function pilihan(){
        return view("public.user.pilihan");
    }
}
