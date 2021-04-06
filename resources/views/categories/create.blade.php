@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Create category</div>
        <div class="card-body">
            
            <form action="{{route('categories.store')}}" method="POST">
                @csrf
                @include('categories.form')
                
                <div class="form-group">
                    <button class="btn btn-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection