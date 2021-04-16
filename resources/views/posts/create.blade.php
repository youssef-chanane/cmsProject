@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Create post</div>
        <div class="card-body">
            
            <x-form action="{{route('posts.store')}}" btnValue="Add Post">
                @include('posts.form')
            </x-form>
        </div>
    </div>
@endsection