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

    <div class="container" >
        <form method="POST" action="{{ route('posts.edit' , $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3" style="margin-top: 20px">
                <h4><label class="form-label fw-bold" style="color: #85586F">Title</label></h4>
                <input type="text" name="title" class="form-control" style="width: 70%; height:40px" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <h4><label class="form-label fw-bold" style="color: #85586F">Description</label></h4>
                <textarea class="form-control" style=" width:80%; height: 100px" name="description">{{ $post->description }}</textarea>
            </div>

            <div class="mb-3">
                <h4><label class="form-label fw-bold" style="color: #85586F">Creator</label></h4>
                <select name="post_creator" class="form-control"  style="width: 70%; height:40px">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                    @endforeach

                </select>
            </div>
            <input class="form-control mb-3" type="file" name="image" >
<center>
            <button type="submit" class="btn" style="background-color:#85586F;color:#FAF8F1;width:40%">Update</button>
</center>
        </form>
    </div>
@endsection
