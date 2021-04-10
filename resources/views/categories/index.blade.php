@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-8"><div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Categories
            <nav class="nav nav-tabs nav-stacked my-5">
                <a href="{{route('categories.index')}}" class="nav-link @if($tab=='list') active @endif">Categories</a>
                <a href="{{route('categories.archive')}}" class="nav-link @if($tab=='archive') active @endif">Archive</a>
                <a href="{{route('categories.all')}}" class="nav-link @if($tab=='all') active @endif">All Categories</a>
            </nav>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($categories as $category) 
                   <li class="list-group-item">
                           {{$category->name}}
                           <p class="fs-5 fst-italic text-muted">created by : {{$category->user->name}}</p> 
                           @if(!$category->deleted_at)
                                @can("update",$category)
                                  <a href="{{route('categories.edit',$category->id
                                  )}}" class="btn btn-success">EDIT</a>
                                @endcan
                                @can("delete",$category)
                                  <form class="d-inline" action="{{route('categories.destroy',$category->id
                                  )}}" method="POST" >
                                     @csrf
                                     @method('DELETE')
                                     <button class="btn btn-primary">archive</button>
                                 </form>
                               @endcan
                            @else
                               @can("restore",$category)
                                 <form class="d-inline" action="{{route('categories.restore',$category->id
                                  )}}" method="POST" >
                                     @csrf
                                     @method('PATCH')
                                     <input type="submit" value="restore" class="btn btn-success" />
                                 </form>
                               @endcan
                               @can("forceDelete",$category)
                                 <form class="d-inline" action="{{route('categories.delete',$category->id
                                  )}}" method="POST" >
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger">delete</button>
                                  </form>
                                @endcan
                               {{-- <button type="button" class="btn btn-danger" id="handleDeleteModal">
                                delete
                              </button> --}}
                              {{-- <!-- Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="deleteModalLabel">delete category</h5>
                                        </div>
                                        <div class="modal-body">
                                          do you realy want to drop this category
                                        </div>
                                        <div class="modal-footer">
                                          <a type="button" class="btn btn-secondary" data-bs-dismiss="modal" href="{{route('categories.archive')}}">cancel</a>
                                          <form class="d-inline" action="{{route('categories.delete',$category->id
                                            )}}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">delete</button>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div> --}}
                            @endif

                       
                   </li>
                   
                @endforeach
            </ul>
        </div>
        <!-- Button trigger modal -->

  
  
    </div>
</div>
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Most Interactive users</h4>
      </div>
      <ul class="list-group list-group-flush">
        @foreach($interactiveUsers as $user)
          <li class="list-group-item">{{$user->name}}
          <p class="text-muted">number of posts :<span class="badge badge-success">{{$user->categories_count}}</span></p>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
    
@endsection

@section('script')
    {{-- <script>
        let btn=document.getElementById("handleDeleteModal");
        btn.addEventListener('click',function(){
            $('#deleteModal').modal('show');
        });
    </script> --}}
@endsection