<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Comment extends Model
{
    protected $fillable = ["user_id","post_id","comment","parent"];
    protected $table = "post_comments";

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

    public function post(){
        return $this->belongsTo("App\User","post_id");
    }

    public function childs(){
        return $this->hasMany("App\Post_Comment",'parent');
    }

    public function parents(){
        return $this->belongsTo("App\Post_Comment","parent");
    }
}
