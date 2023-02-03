@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/posts" enctype="multipart/form-data">
            @csrf


            <div class="mb-3" style="margin-top: 20px">
                <h4><label class="form-label fw-bold" style="color: #85586F">Title</label></h4>
                <input type="text" name="title" class="form-control" style="width: 70%; height:40px">
            </div>


            <div class="mb-3">
                <h4><label class="form-label fw-bold" style="color: #85586F">Description</label></h4>
                <textarea class="form-control" style="height: 100px " name="description"></textarea>
            </div>

            <div class="mb-3">
                <h4><label class="form-label fw-bold" style="color: #85586F">Creator</label></h4>
                <select name="post_creator" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

            </div>
            {{-- <a href="{{route('posts.update', $post['id'])}}" class="btn btn-primary">Edit</a> --}}
            <input class="form-control mb-3" type="file" name="image">

            <button type="submit" class="btn fs-6" style="background-color:#85586F;color:#FAF8F1;width:100%">Create Post
                !</button>
        </form>
    </div>
@endsection
