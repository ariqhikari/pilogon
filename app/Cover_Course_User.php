<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cover_Course_User extends Model
{
    protected $fillable = ["user_id","cover_course_id","index"];
    protected $table = "cover_course_user";
}
