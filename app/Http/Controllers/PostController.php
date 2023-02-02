<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
// use App\Jobs\PruneOldPostsJob;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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
/**1)display all posts in db*/
    public function index()
    {
        //prune jobs
        // dispatch(
        //     new PruneOldPostsJob (
        //         Date::now()->subDays(365*2)
        //     ));

        $allPosts = Post::paginate(4);
        return view('posts.index',[
            'posts' => $allPosts ,
        ]);
    }

        /**2)show certain post for a certain user */
        public function show($postId)
        {
        $post = Post::find($postId);
        $users=User::all();
        return view("posts.show", ['post' => $post , 'users'=> $users]);
    }
    /**3)add to the database (insert values) */
   public function create()
    {
        $users = User::get();
        return view('posts.create',['users' => $users,
        ]);
    }

    /**4)store the post in db
    StorePostRequest => make the user authorized*/
    public function store( StorePostRequest $request)
    {
        /** validation fot title and desc*/
        $request->validate([
            'title'=>['required','min:3','unique:posts,title'],
            'description'=>['required','min:10'],
         ]);
        //  dd($request->all());
         /**image*/
         $path = Storage::putFile('public', $request->file('image'));
         /**posts*/
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

    /** 5)edit a certain post or image if the user decided to edit*/
    public function edit($postId)
    {
        $post = Post::find($postId);
        $users = User::get();
        return view('posts.update',['post' =>$post , 'users'=>$users]);
}

        /**6)update in db */
    public function update($postId, UpdatePostRequest $request)
        {
            //validation
            // $request->validate([
            //     'title'=>['required','min:3','unique:posts,title,'. $postId],
            //     'description'=>['required','min:10'],
            //     'user_id'=>[Rule::in('post_creator','user_id')],
            // ]);

            /**get all data */
                $newPost = request()->all();
                $post = Post::find($postId);
                /**update the image */
                if ($request->exists('image')) {
                        /**upload image  */
                    $path = Storage::putFile('public', $request->file('image'));
                        /**delete old image*/
                        Storage::delete($post->image);
                }
                else{
                    $path=null;
                }
                /** update the post */
                $post->slug = null;
                $post->title = $newPost['title'];
                $post->description = $newPost['description'];
                $post->image = $path;

                $post->save();


                return redirect()->route('posts.index',['post' => $postId]);

        }

        /**7)delete a post*/
    public function destroy($postId)
        {
            Post::find($postId)->delete();
            return back();
        }


        /**8)restore a certain post */
        public function restore()
        {
            $allPosts = Post::onlyTrashed()->get();
            return view('posts.restore', ['posts' => $allPosts,]);
        }


        /**9)display the post back */
        public function reback($postId)
        {
            Post::whereId($postId)->restore();
            return back();
        }
}
