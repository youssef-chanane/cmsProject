@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Create post</div>
        <div class="card-body">
            
            <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('posts.form')
                
                <div class="form-group">
                    <button class="btn btn-success">Add Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection