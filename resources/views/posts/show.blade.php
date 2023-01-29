@extends('layouts.app')
@section('title') Show @endsection
@section('content')

 <form method="POST" action="/posts">
        @csrf
        <div class="card" style="margin-bottom: 80px; margin-top:20px">
            <div class="card-header" >
              Post Info
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><label class="form-label" name="title">Title :-{{$post->title??"Not Found"}}</label><br>
                <label  class="form-label" name="description">Description :-{{$post->description ??"Not Found"}}</label>
              </li>
          </div>


          <div class="card" >
            <div class="card-header">
              Post Creator Info
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><label class="form-label" name="name">Name :-{{$post->user->name?? "Not Found"}}</label><br>
                <label  class="form-label" name="email">Email :-{{$post->user->email?? "Not Found"}}</label> <br>
                {{-- <label  class="form-label" name = "created_at">Created at :-{{ $post->created_at ? $post->created_at->format('jS \o\f F, Y g:i:s a'):"NULL"}}</label> --}}

              </li>
          </div>

    </form>
@endsection
