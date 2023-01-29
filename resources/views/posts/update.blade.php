@extends('layouts.app')

@section('title') Edit @endsection

@section('content')
 <form method="POST" action="/posts">
        @csrf

        <div class="mb-3" style="margin-top: 20px">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{$post->title}}" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                class="form-control"
                name="description"
            >{{$post->description}}</textarea>
        </div>

            <div class="mb-3">
                <label class="form-label">Creator</label>
                <select name="post_creator" class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach

                </select>
            </div>

        <button type="submit" class="btn btn-success">Update</button>
 </form>

@endsection
