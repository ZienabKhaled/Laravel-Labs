@extends('layouts.app')

@section('title') Edit @endsection

@section('content')
 <form method="POST" action="/posts">
        @csrf

        @foreach($posts as $post)
        @if($post['id']==$postId)
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" value="{{$post['title']}}" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                class="form-control"
            >{{ $post['description'] }}</textarea>
        </div>

            <div class="mb-3">
                <label class="form-label">Creator</label>
                <input type="text" class="form-control" value="{{$post['posted_by']}}" >
            </div>


        <button type="submit" class="btn btn-success">Update</button>
        @endif
        @endforeach
    </form>

@endsection
