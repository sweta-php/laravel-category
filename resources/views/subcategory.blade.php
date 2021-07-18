@extends('layouts.app')

@section('content')
<div class="container">
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<a href="{{ route('subcategory.create') }}" class="btn btn-primary float-right" role="button" aria-disabled="true"> + Add Sub-Category</a>
</br>
</br>
</br>
<div class="navbar-search-block float-right">
<form class="form-inline" method="get" action="./subsearch">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar float-right" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar float-right" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
</form>
</div>
<div>
    <h3>Sub-Category</h3>
</div>

</br>

<table class="table" id="table">

    <thead>
        <tr>

        <td>Id</td>
                                <td> Category</td>
                                <td>Sub-Category</td>
                                <td>Created Date</td>
                                <td>Updated Date</td></td>
                                <td>Actions</td>    

        </tr>
    </thead>
    <tbody>
        @foreach($subcategories as $subcategory)
        <tr class="item{{$subcategory->id}}">

<td> {{$subcategory->id}}</td>
<td> {{$subcategory->cname}} </td>

            <td>{{$subcategory->name}}</td>
            <td>{{$subcategory->created_at}}</td>
            <td>{{$subcategory->updated_at}}</td>


            <td class="row">


                <form method="post" action="{{url('/subcategory/edit',($subcategory->id))}}">

                    {{ csrf_field() }}
                    <button class="delete-modal btn btn-success" type=submit>
                        Edit
                    </button>

                </form>
 
                    <button type="button" class="delete-modal btn btn-danger" data-toggle="modal"   data-target="#exampleModal{{$subcategory->id}}">
  Delete
</button>

<div class="modal fade" id="exampleModal{{$subcategory->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" id="form1" action="{{url('/subcategory/delete' ,($subcategory->id))}}">
      <div class="modal-header">
      

                    {{ csrf_field() }}
        <h5 class="modal-title" id="exampleModalLabel">DELETE CONFIRMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Are you sure to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button class="btn btn-danger" type="submit">Yes ! Delete</button>
        </form>

      </div>
    </div>
  </div>
</div>
                
            </td>
        
        </tr>
        @endforeach

    </tbody>

</table>
<div class="pagination">

{{ $subcategories->links() }}

</div>

                
                  

                  
@endsection
