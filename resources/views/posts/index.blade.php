@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($posts as $post) 
                   <li class="list-group-item">
                           {{$post->image}}
                   </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection