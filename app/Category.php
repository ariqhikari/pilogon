<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug',"gambar"];
    protected $table = "categorys";
    
    public function covercourse(){
        return $this->belongsToMany("App\CoverCourse");
    }

    public function getRouteKeyName(){
        return "slug";
    }

    public function forums(){
        return $this->belongsToMany("App\Forum");
    }
}
