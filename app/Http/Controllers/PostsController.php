<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index',['posts'=>Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestPost $request)
    {
        //stocké l'image dans le dossier posts dans stprage
        $path=$request->file('image')->store('posts');
        $data=$request->only(['title','description','content']);
        $data['image']=Storage::url($path);
        $data['user_id']=$request->user()->id;
        Post::create($data);
        $request->session()->flash('success','post was created successefuly!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Cache::remember("post-show-{$id}",60,function() use ($id){
            return Post::find($id); 
        });
        //posts published by the same user
        $posts=Cache::remember("posts-show-{$id}",60,function()use($post){
            return Post::where('user_id',$post->user_id)->get(); 
        });
        return view('posts.show',[
            'post'=>$post,
            'postsOfUser'=>$posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        return view('posts.edit',[
            "post"=>$post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestPost $request, $id)
    {
        $post=Post::find($id);
        $this->authorize("update",$post);
        Storage::delete($post->image);
        $path=$request->file('image')->store('posts');
        $post->title=$request->title;
        $post->content=$request->content;
        $post->description=$request->description;
        $post->image=Storage::url($path);
        $post->user_id=$request->user()->id;
        $post->save();
        $request->session()->flash('success','post was updated successufuly !');
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize("delete",Post::find($id));
        Post::destroy($id);
        session()->flash('success','post was deleted successufuly !');
        return redirect()->route('posts.index');
    }
}
