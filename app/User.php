<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
use App\CoverCourse;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','foto','permission','slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName(){
        return "slug";
    }

    public static function permissions(){
        return [
            "admin" => "Administrator",
            "pemateri" => "Pemateri",
            "murid" => "Murid" 
        ];
    }

    public function profiles(){
        return $this->hasMany("App\Profile","user_id");
    }

    public function courses(){
        return $this->hasMany("App\CoverCourse","user_id");
    }

    public function course_registered(){
        return $this->belongsToMany("App\CoverCourse")->withPivot("index");
    }

    public function modules(){
        $jumlah = 0;
        $cover = CoverCourse::where("user_id",Auth::id())->get();
        foreach ($cover as $key => $value) {
            $jumlah += $value->modules->count();
        }
        return $jumlah;
    }

    public function pendaftar(){
        $jumlah = 0;
        $cover = CoverCourse::where("user_id",Auth::id())->get();
        foreach ($cover as $key => $value) {
            $jumlah += $value->userRegistered->count();
        }

        return $jumlah;
    }

    public function comments(){
        return $this->hasMany("App\Comment_Forum","user_id");
    }

    public function forums(){
        return $this->hasMany("App\Forum","user_id");
    }

    public function like_forums(){
        return $this->hasMany("App\Like_Forum","user_id");
    }

    public function total_jawaban(){
        $forums = Forum::where("user_id",Auth::id())->get();
        $total = 0;
        foreach ($forums as $key => $value) {
            $total += $value->comments->count();
        }
        
        return $total;
    }

    public function posts(){
        return $this->hasMany("App\Post","user_id");
    }

    public function uploaded_post(){
        $total = 0;
        foreach (Auth::user()->posts as $key => $value) {
            if ($value->status == 1) {
                $total += 1;
            }
        }

        return $total;
    }

    public function drafted_post(){
        $total = 0;
        foreach (Auth::user()->posts as $key => $value) {
            if ($value->status == 0) {
                $total += 1;
            }
        }

        return $total;
    } 
}
