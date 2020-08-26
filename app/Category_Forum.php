<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Forum extends Model
{
    protected $fillable = ["forum_id","category_id"];
    protected $table = "category_forum";
}
