@extends('layouts.app')

@section('title')Create @endsection

@section('content')
 <form method="POST" action="/posts">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                class="form-control"
                name="description"
            ></textarea>
        </div>
        <div class="mb-3">
            <select name="post_creator" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach

            </select>

        </div>
        {{-- <a href="{{route('posts.update', $post['id'])}}" class="btn btn-primary">Edit</a> --}}

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
