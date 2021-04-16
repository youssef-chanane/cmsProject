@extends('layouts.app')
@section('content')
<div class="containet">
    <div class="row">
        <div class="col-8">
            
            <div class="card card-default">
                <div class="card-body">
                    <ul class="list-group">
                            <x-card src="{{$post->image}}" title="{{$post->title}}" description="{{$post->description}}" content="{{$post->content}}">
                                @can("update",$post)
                                    <a href="{{route('posts.edit',$post->id
                                        )}}" class="btn btn-success">EDIT</a>
                                @endcan
                                @can('delete',$post)
                                    <form class="d-inline" action="{{route('posts.destroy',$post->id
                                        )}}" method="POST" >
                                           @csrf
                                           @method('DELETE')
                                           <button class="btn btn-danger">delete</button>
                                    </form>
                                @endcan
                            </x-card>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Posts published By the same seller</h4>
              </div>
              <ul class="list-group list-group-flush">
                @foreach($postsOfUser as $post)
                    <a class="m-2 text-muted text-decoration-none"href="{{route('posts.show',$post->id
                            )}}" >
                        <x-card src="{{$post->image}}" title="{{$post->title}}" description="" content="1">
                        </x-card>
                    </a>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
    </div>
</div>
    
@endsection