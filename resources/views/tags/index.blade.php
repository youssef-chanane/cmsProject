@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-8"><div class="d-flex justify-content-end mb-2">
        <a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Tags
            <nav class="nav nav-tabs nav-stacked my-5">
                <x-nav-link route="tags.index" tab={{$tab}} active="list">Tags</x-nav-link>
                <x-nav-link route="tags.archive" tab={{$tab}} active="archive">archive</x-nav-link>
                <x-nav-link route="tags.all" tab={{$tab}} active="all">all</x-nav-link>
            </nav>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($tags as $tag)
                   <li class="list-group-item">
                    <a href="{{route('posts.tag.index',['id'=>$tag->id])}}">{{$tag->name}}</a>
                    
                       @if(!$tag->deleted_at)
                            @can("update",$tag)
                            <a href="{{route('tags.edit',$tag->id
                            )}}" class="btn btn-success">EDIT</a>
                            @endcan
                            @can("delete",$tag)
                            <form class="d-inline" action="{{route('tags.destroy',$tag->id
                            )}}" method="POST" >
                               @csrf
                               @method('DELETE')
                               <button class="btn btn-primary">archive</button>
                             </form>
                             @endcan
                             @else
                               @can("restore",$tag)
                                 <form class="d-inline" action="{{route('tags.restore',$tag->id
                                  )}}" method="POST" >
                                     @csrf
                                     @method('PATCH')
                                     <input type="submit" value="restore" class="btn btn-success" />
                                 </form>
                               @endcan
                               @can("forceDelete",$tag)
                                 <form class="d-inline" action="{{route('tags.delete',$tag->id
                                  )}}" method="POST" >
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger">delete</button>
                                  </form>
                                @endcan
                            @endif
                    </li> 
                @endforeach
            </ul>
        </div>
@endsection