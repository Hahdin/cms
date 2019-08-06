@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{isset($category) ? 'Edit Category' : 'Create Category'}}

    </div>
    <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method="POST">
        @csrf
        @if(isset($category))
            @method('PATCH')
        @endif
        <div class="form-group">

            <label for="name">Category Name</label>
            <input
                type="text" class="form-control"
                name="name" id="name"
                placeholder="Category Name" value="{{isset($category) ? $category->name : old('name')}}">
        </div>
        <div class="form-group">
            <button class="btn btn-success">{{isset($category) ? 'Update Category' : 'Add Category'}}</button>
        </div>
        </form>
    </div>
    @include('errors')

</div>

@endsection

