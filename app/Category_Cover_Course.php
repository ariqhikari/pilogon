<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Cover_Course extends Model
{
    protected $fillable = ['category_id',"cover_course_id"];
    protected $table = "category_cover_course";
}
