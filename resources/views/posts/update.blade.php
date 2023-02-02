@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form method="POST" action="{{ route('posts.edit' , $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3" style="margin-top: 20px">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description">{{ $post->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Creator</label>
                <select name="post_creator" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach

                </select>
            </div>
            <input class="form-control" type="file" name="image" >

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
