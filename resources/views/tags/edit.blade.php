@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">update tag</div>
    <div class="card-body">
    <x-form action="{{route('tags.update',$tag->id)}}" btnValue="edit tag">
        @include('tags.form')
        @method('PUT')
    </x-form>
    </div>
</div>
@endsection