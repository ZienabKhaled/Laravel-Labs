@extends('layouts.app')
@section('title')
    Show
@endsection
@section('content')
    <div class="container">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card" style="margin-bottom: 50px; margin-top:20px;width:700px;">
                        <div class="card-header">
                            <h4>Post Info</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><label class="form-label" name="title">Title
                                    :-{{ $post->title ?? 'Not Found' }}</label><br>
                                <label class="form-label" name="description">Description
                                    :-{{ $post->description ?? 'Not Found' }}</label>
                            </li>
                    </div>

                    <div class="card" style="margin-bottom: 50px;width: 700px">
                        <div class="card-header">
                            <h4>Post Creator Info</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><label class="form-label" name="name">Name
                                    :-{{ $post->user->name ?? 'Not Found' }}</label><br>
                                <label class="form-label" name="email">Email
                                    :-{{ $post->user->email ?? 'Not Found' }}</label> <br>
                                <label class="form-label" name="created_at">Created at
                                    :-{{ $post->created_at ? $post->created_at->format('jS \o\f F, Y g:i:s a') : 'NULL' }}</label>
                            </li>
                    </div>
                </div>

                {{--  Create a comment --}}
                <div class="col">
                    <form method="POST" action="{{ route('comments.store', $post->id) }}">
                        @csrf
                        <div class="mb-3">

                            <h3><label class="form-label" style="color: green">Add Comment</label>
                                <textarea class="form-control" placeholder="Add Your Comment" name="body"
                                    style="width: 500px;
                            height:100px;"></textarea>
                            </h3>
                        </div>
                        <button type="submit" class=" btn btn-outline-success">Post Your Comment</button>
                    </form>





            {{-- card --}}
            <h1>Post image</h1>
            <div >
                <img src="{{ Storage::url($post->image) }}" alt="" name="image" style="height: 200px ; width:100%">
            </div>
        </div>
        </div>
        </div>
        {{-- Show the comment in the same page --}}
        <h1>Post Comments</h1>
        @foreach ($post->comments as $comment)
            <div class="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h5>Comment #{{ $comment->id }}</h5>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Posted at {{ $comment->created_at->format('20y/m/d') }}.</strong>
                            {{ $comment->body }}
                        </div>
                        {{-- <a href="{{ route('posts.show', $comment->id) }}" class="btn btn-primary">Edit</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
