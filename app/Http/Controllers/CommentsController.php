<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreComment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(RequestStoreComment $request,$id){
        $post=Post::find($id);
        $post->comments()->create([
            'content'=>$request->content,
            'user_id'=>$request->user()->id
        ]);

        return redirect()->back();

    }
}
