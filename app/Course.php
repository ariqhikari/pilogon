<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ["title","materi","user_id","cover_course_id","code"];

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

    public function cover_course(){
        return $this->belongsTo("App\CoverCourse","cover_course_id");
    }
}
