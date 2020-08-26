<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'Forums';

    protected $fillable = ["user_id","title","problem","slug"];

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

    public function getRouteKeyName(){
        return "slug";
    }

    public function categorys(){
        return $this->belongsToMany("App\Category");
    }

    public function likes(){
        return $this->hasMany("App\Like_Forum","forum_id");
    }

    public function comments(){
        return $this->hasMany("App\Comment_Forum","forum_id");
    }
}
