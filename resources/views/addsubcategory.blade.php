@extends('layouts.app')
@section('content')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add New Sub Category') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('subcategory.create') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>
                                <div class="col-md-6"> <select class="form-control @error('category') is-invalid @enderror" id="category-dropdown" name="category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">
                                            {{$category->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="add">
                                        {{ __('Add') }}
                                    </button>
                                    <a href="{{url('/subcategory')}}" class="btn btn-secondary offset-md-0.5">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection