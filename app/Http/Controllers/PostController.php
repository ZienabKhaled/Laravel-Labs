<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use DB;

class PostController extends Controller
{
    public function githubredirect(Request $request)
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubcallback(Request $request)
    {
        $userdata = Socialite::driver('github')->user();
        $user = User::where('email', $userdata->email)->where('auth_type','github')->first();
        if (!$user) {
            $uuid=Str::uuid()->toString();
            $user = new User();
            $user->name = $userdata->name;
            $user->email = $userdata->email;
            $user->password = Hash::make($uuid.now());
            $user->auth_type = 'github';
            $user->save();
            Auth::login($user);
            return redirect('/home');
            }

        else{

            Auth::login($user);
            return redirect('/home');
        }
    }

    public function googleredirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback(Request $request)
    {
        $userdata = Socialite::driver('google')->user();
        $user = User::where('email', $userdata->email)->where('auth_type','google')->first();
        if (!$user) {
            $uuid=Str::uuid()->toString();
            $user = new User();
            $user->name = $userdata->name;
            $user->email = $userdata->email;
            $user->password = Hash::make($uuid.now());
            $user->auth_type = 'google';
            $user->save();
            Auth::login($user);
            return redirect('/home');
            }

        else{
            Auth::login($user);
            return redirect('/home');
        }
    }

    public function index()
    {
        dispatch(
            new PruneOldPostsJob (
                Date::now()->subDays(365*2)
            ));

        $allPosts = Post::with('user')->paginate(6);
        return view('posts.index',[
            'posts' => $allPosts ,
        ]);
    }

        public function show($postId)
        {
        $post = Post::find($postId);
        $users=User::all();
        return view("posts.show", ['post' => $post , 'users'=> $users]);
    }
   public function create()
    {
        $users = User::get();
        return view('posts.create',['users' => $users,
        ]);
    }


    public function store( StorePostRequest $request)
    {
        //  dd($request->all());
         $path = Storage::putFile('public', $request->file('image'));
        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'image' => $path
        ]);
        return to_route('posts.index');
    }

    public function edit($postId)
    {
        $post = Post::find($postId);
        $users = User::get();
        return view('posts.update',['post' =>$post , 'users'=>$users]);
}

    public function update($postId, UpdatePostRequest $request)
        {
                $newPost = request()->all();
                $post = Post::find($postId);
                if ($request->exists('image')) {
                    $path = Storage::putFile('public', $request->file('image'));
                    if($post->image){
                        Storage::delete($post->image);
                }}
                else{
                    $path=null;
                }
                $post->slug = null;
                $post->title = $newPost['title'];
                $post->description = $newPost['description'];
                $post->image = $path;
                $post->save();
                return redirect()->route('posts.index',['post' => $postId]);

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
