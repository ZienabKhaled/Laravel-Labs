<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
// use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Date;
use DB;

class PostController extends Controller
{
    //show all ( select *)
    public function index()
    {
        // dispatch(
        //     new PruneOldPostsJob (
        //         Date::now()->subDays(365*2)
        //     ));

        $allPosts = Post::paginate(4);
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


    public function store( StorePostRequest $request)
    {
        // validation
        $request->validate([
            'title'=>['required','min:3','unique:posts,title'],
            'description'=>['required','min:10'],
         ]);

        $data = $request->all();
        $title = $data['title'];
        // $title->slug = Str::slug( $data['slug']) ;
        $description = $data['description'];
        $userId = $data['post_creator'];
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
        ]);
        return to_route('posts.index');
    }

    public function edit($postId)
    {
        $post = Post::find($postId);
        $users = User::get();
        return view('posts.update',['post' =>$post , 'users'=>$users]);
}
public function update($postId, StorePostRequest $newPost)
    {
        //validation
        $newPost->validate([
            'title'=>['required','min:3','unique:posts,title,'. $postId],
            'description'=>['required','min:10'],
            'user_id'=>[Rule::in('post_creator','user_id')],

        ]);

        $newPost = request()->all();
        if ($newPost['title'] && $newPost['description'] ) {
            $post = Post::find($postId);
            $post->slug = null;
            $post->title = $newPost['title'];
            // $post->slug = Str::slug( $newPost['slug']) ;
            $post->description = $newPost['description'];
            $post->save();
            return redirect()->route('posts.index');
        }
        else {
            return redirect()->route('posts.update', ['post' => $postId]);
        }
    }
    public function show($postId)
    {
    $post = Post::find($postId);
    return view("posts.show", ['post' => $post]);
}
public function destroy($postId)
    {
        Post::find($postId)->delete();
        return back();
    }

     public function restore()
     {
        $allPosts = Post::onlyTrashed()->get();
         return view('posts.restore', ['posts' => $allPosts,]);
     }

     public function reback($postId)
     {
        Post::whereId($postId)->restore();
        return back();
     }
}
