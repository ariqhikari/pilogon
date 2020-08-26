<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like_Forum extends Model
{
    protected $fillable = ["user_id","forum_id"];
    protected $table = "like_forums";
}
