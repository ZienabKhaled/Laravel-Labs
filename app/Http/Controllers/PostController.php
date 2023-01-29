<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //show all ( select *)
    public function index()
    {

        $allPosts = Post::all();
        return view('posts.index',[
            'posts' => $allPosts ,
        ]);
    }

    //add to the database (insert values)
   public function create()
    {
        $users = User::get();

        return view('posts.create',[
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];
        //store the form data inside the database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
        ]);

        return to_route('posts.index');
    }

    public function archive ($postId){
        $post = Post::onlyTrashed ($postId);
        $post -> archive();
        return view('posts.archive',['post' =>$post ]);

    }

    public function show($postId)
    {
    $post = Post::find($postId);
    return view("posts.show", ['post' => $post]);
}


    public function edit($postId)
    {
        $post = Post::find($postId);
        $users = User::get();
        return view('posts.update',['post' =>$post , 'users'=>$users]);
}

public function destroy($postId)
{
    $post = Post::find($postId);
    $post->delete();
    return redirect()->route('posts.index');
}

public function restore($postId)
     {

        Post::withTrashed()->find($postId)->restore();
        return redirect()->route('posts.index');
     }
}
