@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{route('posts.create')}}" class="btn btn-success float-right mb-2">Add Post</a>
</div>

<div class="card card-default">
    <div class="card-header">{{strstr($_SERVER['REQUEST_URI'], 'trashed') ? 'Trashed Posts' : 'Posts'}}</div>
    @if(!$posts->count() > 0)
        <h3>No Post Records</h3>
    @else
    <table class="table">
        <thead>
            <th>Image</th>
            <th>Title</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr class=" {{ $post->trashed() ? 'is_trashed' : 'is_not_trashed'}}">
                <td><img src="{{asset('storage/'. $post->image)}}" alt="{{asset($post->image)}}" width="100px"></td>
                <td>{{$post->title}}</td>
                <td>
                    @if($post->trashed())
                    <form action="{{route('restore-posts', $post->id)}}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="submit" class="btn btn-info btn-sm">Restore</button>
                    </form>
                    @else
                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>
                    @endif
                </td>
                <td>
                    <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                        @csrf
                        @method("DELETE")

                        <button type="submit" class="{{$post->trashed() ? 'btn btn-danger' : 'btn btn-warning btn-sm' }}">
                            {{ $post->trashed() ? 'Delete' : 'Trash'}}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection

@section('scripts')
@endsection
