<?php

namespace App\Http\Controllers;

use App\Like_Forum;
use Illuminate\Http\Request;
use Auth;

class Like_ForumController extends Controller
{
    public function like($forum){
        Like_Forum::create([
            "user_id" => Auth::id(),
            "forum_id" => $forum
        ]);

        return redirect()->back();
    }

    public function unlike($forum){
        $likes = Like_Forum::where("user_id",Auth::id())->where("forum_id",$forum)->first();
        $likes->delete();
        return redirect()->back();
    }
}
