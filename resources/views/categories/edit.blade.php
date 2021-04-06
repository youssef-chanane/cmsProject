@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Update category</div>
        <div class="card-body">
            
            <form action="{{route('categories.update',$category->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('categories.form')
               
                <div class="form-group">
                    <button class="btn btn-success">Update Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection