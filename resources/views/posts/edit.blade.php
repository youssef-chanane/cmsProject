@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Edit Post</div>
        <div class="card-body">
            
            <x-form action="{{route('posts.update',$post->id)}}" btnValue="Update Post">
                @method('PUT')
                @include('posts.form')
                
            </x-form>
        </div>
    </div>
@endsection