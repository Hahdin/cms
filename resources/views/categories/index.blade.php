@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{route('categories.create')}}" class="btn btn-success float-right mb-2">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header">
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Name</th>
                <th></th>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>
                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">Edit

                        </a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete Category</button>
                    </td>
                </tr>

                @endforeach
            </tbody>
            </thead>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <form action="" method="POST" id="deleteCategory">
                @csrf
                @method('DELETE')
                <div class="modal-dialog" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this category and all its posts?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const handleDelete = (id) =>{
        let form = document.getElementById('deleteCategory');
        form.action = '/categories/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
