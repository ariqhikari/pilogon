<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title","slug","content","user_id","category_id","thumbnail","status"];

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

    public function category(){
        return $this->belongsTo("App\Category","category_id");
    }

    public function comments(){
        return $this->hasMany("App\Post_Comment","post_id");
    }

    public function getRouteKeyName(){
        return "slug";
    }

    public function views(){
        return $this->hasMany("App\View","post_id");
    }
}
