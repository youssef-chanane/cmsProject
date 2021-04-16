@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Update category</div>
        <div class="card-body">
            
            <x-form action="{{route('categories.update',$category->id)}}" btnValue="Update Category">
                @method('PUT')
                @include('categories.form')
            </x-form>
        </div>
    </div>
@endsection