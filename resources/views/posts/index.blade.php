@extends('layouts.app')
@section('content')
<div class="containet">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{route('posts.create')}}" class="btn btn-success">{{__('Add')}} Post</a>
            </div>
            <div class="card card-default">
                <div class="card-header">Posts</div>
                <div class="card-body">
                    <ul class="list-group d-flex flex-wrap justify-content-center flex-row">
                        @foreach ($posts as $post)
                            <x-card src="{{isset($post->image) ? $post->image->path : ''}}" title="{{$post->title}}" description="" content="">
                                <p>category: {{$post->category->name}}</p>
                                    <a href="{{route('posts.show',$post->id
                                        )}}" class="btn btn-success">{{__('Show')}}</a>
                            </x-card>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection