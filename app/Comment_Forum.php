<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Forum extends Model
{
    protected $fillable = ["user_id","forum_id","comment","parent"];
    protected $table = "comment_forums";

    public function childs(){
        return $this->hasMany("App\Comment_Forum",'parent');
    }

    public function parents(){
        return $this->belongsTo("App\Comment_Forum","parent");
    }

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

    public function forum(){
        return $this->belongsTo("App\Forum","forum_id");
    }
}
