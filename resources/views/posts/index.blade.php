@extends('layouts.app')
@section('title')
    Index
@endsection
@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <div class="row d-flex">
        <div class="col-lg-12 col-md-9 col-sm-6">
            <div class="container">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Posted By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name ?? 'Not Found' }}</td>
                                <td>{{ $post->created_at->format('20y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('posts.update', $post->id) }}" class="btn btn-primary">Edit</a>

                                    <form class="delete-post" action="{{ route('posts.destroy', $post->id) }}"
                                        method="POST">
                                        @csrf
                                        @if ($post->trashed())
                                            @method('PATCH')
                                        @else
                                            @method('DELETE')
                                        @endif
                                        <input type="submit" data-bs-toggle="modal" data-bs-target="#myModal"
                                            value=" Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal show" id="myModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to delete?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modelConfirm" class="btn btn-danger">Delete Anyway</button>
                    <button type="button" id="cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script>
        let deleteForm = document.querySelectorAll('.delete-post');
        let confirmDelete = document.getElementById("modelConfirm")
        deleteForm.forEach(form => {
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                $('#myModal').modal('show')
                confirmDelete.addEventListener('click', function(e) {
                    $('#myModal').modal('hide');
                    form.submit()
                })
            })

        });
    </script>
@endsection
