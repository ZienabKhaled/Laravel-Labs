@extends('layouts.app')

@section('title') Show @endsection

@section('content')
 <form method="show" action="/posts">
        @csrf
        @foreach($posts as $post)
        @if($post['id']==$postId)

        <div class="card" style="margin-bottom: 80px; margin-top:20px">
            <div class="card-header" >
              Post Info
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><label class="form-label">Title :-{{$post['title']}}</label><br>
                <label  class="form-label">Description :-{{$post['description']}}</label>
              </li>
          </div>


          <div class="card" >
            <div class="card-header">
              Post Creator Info
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><label class="form-label">Name :-{{$post['posted_by']}}</label><br>
                <label  class="form-label">Email :-</label> <br>
                <label  class="form-label">Created at :-{{$post['created_at']}}</label>

              </li>
          </div>
@endif
@endforeach

    </form>
@endsection
