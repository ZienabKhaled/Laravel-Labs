@extends('layouts.app')

@section('title') create @endsection

@section('content')
 <form method="POST" action="/posts">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                class="form-control"
            ></textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>
            <input type="text" class="form-control" >

        </div>
                            {{-- <a href="{{route('posts.update', $post['id'])}}" class="btn btn-primary">Edit</a> --}}

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
