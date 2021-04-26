<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUpdatePost;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verifyCategoriesCount')->only(['create','edit']);
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
        $categories=Category::all();
        $tags=Tag::all();
        return view('posts.create',[
            "categories"=>$categories,
            "tags"=>$tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUpdatePost $request)
    {
        //stocké l'image dans le dossier posts dans storage
        $path=$request->file('image')->store('posts');
        $data=$request->only(['title','description','content']);
        $data['image']=Storage::url($path);
        $data['user_id']=$request->user()->id;
        $data['category_id']=$request->category;
        //dd($data);
         //relier le post à des tags
         $tags=$request->tags;
         $post=Post::create($data);
         $post->tags()->attach($tags);
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
        $post=Post::find($id);
        $posts=Post::where('user_id',$post->user_id)->get();
        // $post=Cache::remember("post-show-{$id}",60,function() use ($id){
        //     return Post::find($id); 
        // });
        // //posts published by the same user
        // $posts=Cache::remember("posts-show-{$id}",60,function()use($post){
        //     return Post::where('user_id',$post->user_id)->get(); 
        // });
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
        $categories=Category::all();
        $tags=Tag::all();
        return view('posts.edit',[
            "post"=>$post,
            "categories"=>$categories,
            "tags"=>$tags

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUpdatePost $request, $id)
    {
        $data=$request->only(['title','description','content']);
        $post=Post::find($id);
        $this->authorize("update",$post);
        if($request->hasFile('image')){
            Storage::delete($post->image);
            $path=$request->file('image')->store('posts');
            $data['image']=Storage::url($path);
        }
        $data['user_id']=$request->user()->id;
        $data['category_id']=$request->category;
        //relier le post à des tags
        $tags=$request->tags;
        $post->tags()->sync($tags);
         
        $post->update($data);
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
        session()->flash('error','post was deleted successufuly !');
        return redirect()->route('posts.index');
    }
}
