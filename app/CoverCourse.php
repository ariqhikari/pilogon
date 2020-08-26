<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverCourse extends Model
{
    protected $fillable = ['title','title','slug','thumbnail','description','status','level','user_id'];
    protected $table = 'cover_courses';

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

    public function getRouteKeyName(){
        return "slug";
    }

    public function categorys(){
        return $this->belongsToMany("App\Category");
    }

    public function modules(){
        return $this->hasMany("App\Course","cover_course_id");
    }

    public function userRegistered(){
        return $this->belongsToMany("App\User")->withPivot("index");
    }
}