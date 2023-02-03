@extends('layouts.app')
@section('title')
    Show
@endsection
@section('content')
    <div class="container">
        <center>
            <div class="card mb-3 mt-3 " style="width: 80% ">
                <div class="row g-0">
                    <div>
                        @if ($post->image)
                            <img src="{{ Storage::url($post->image) }}" class="img-fluid rounded-start rounded-0"
                                style="height: 350px ; width:100%">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="text-align: left">
                            <h2 class="card-title fw-bold" style="color:#85586F">{{ $post->title ?? 'Not Found' }}</h2>
                            <hr>
                            <p class="card-text">{{ $post->description ?? 'Not Found' }}.</p>
                            <p class="card-text">{{ $post->user->name ?? 'Not Found' }}<small class="text-muted ">
                                    {{ $post->created_at ? $post->created_at->format('jS \o\f F, Y g:i:s a') : 'NULL' }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Display all the comments --}}
            <div class="row">
                <div class="col">
                    @if ($post->comments)
                        @foreach ($post->comments as $comment)
                            <div class="card mb-2" style="width: 80%">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <label class="form-label">
                                            <h4>Comment #{{ $comment->id }}</h4>
                                            <hr><strong>{{ $comment->body }}</strong><br>

                                            {{ $post->user->name }}, {{ $comment->created_at->format('20y-m-d') }}
                                        </label>
                                        <br>

                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    @endif

                    {{--  Create a comment --}}
                    <div class="col">
                        <form method="POST" action="{{ route('comments.store', $post->id) }}">
                            @csrf
                            <textarea class="form-control" placeholder="Add Your Thoughts ..." name="body"
                                style="width: 70%;
            height:100px; border-color:#85586F"></textarea>
                            <button type="submit" class=" btn mt-2 text-light"
                                style="width:70%; border-color:#85586F ; background-color:#85586F">Post Your
                                Comment</button>
                        </form>
                    </div>
                </div>
            </div>

        </center>
    </div>
@endsection
