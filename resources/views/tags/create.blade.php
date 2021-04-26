@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">Create tag</div>
    <div class="card-body">
    <x-form action="{{route('tags.store')}}" btnValue="create tag">
        @include('tags.form')
    </x-form>
    </div>
</div>
@endsection