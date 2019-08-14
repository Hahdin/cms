@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? 'Edit Post' : 'Create Post'}}
    </div>
    <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control"
                name="title" id="title"  placeholder="title"
                value="{{ isset($post) ? $post->title : old('title')}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5"
                    class="form-control" placeholder="description">{{ isset($post) ? $post->description : old('description')}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : old('content')}}">
                <trix-editor input="content"></trix-editor>

            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" name="published_at" id="published_at"  placeholder="published at"  value="{{ isset($post) ? $post->published_at : old('published_at')}}">
            </div>
            @if(isset($post))
                <div class="form-group">
                    <img src="{{asset('storage/'. $post->image)}}" alt="{{$post->image}}" style="width: 100%">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image"  placeholder="upload image"  value="{{ isset($post) ? $post->image : old('image')}}">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success" type="submit">{{ isset($post) ? 'Update Post' : 'Create Post'}}</button>
        </form>
    </div>
</div>
@include('errors')

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#published_at', {
        enableTime: true,
        nextArrow: 'next',
        prevArrow:'prev',
        position: 'above',
        weekNumbers: true,
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
