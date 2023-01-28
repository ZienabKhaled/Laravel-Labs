@extends('layouts.app')
@section('title') index @endsection
@section('content')
    <div class="text-center">
        <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
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
        @foreach($posts as $post)
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['posted_by']}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.update', $post['id'])}}" class="btn btn-primary">Edit</a>
                    <form method="destroy" action="/posts">
                    <a href="{{route('posts.destroy', $post['id'])}}" class="btn btn-danger">Delete</a>
                </form>
                </td>
            </tr>
        @endforeach
                </tbody>
          </table>
        </div>
    </div>
    </div>
@endsection
