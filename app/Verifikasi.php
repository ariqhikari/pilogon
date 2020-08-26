<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    protected $fillable = ["cover_course_id","status"];
    protected $table = "verifikasies";

    public function course(){
        return $this->belongsTo("App\CoverCourse","cover_course_id");
    }
}
