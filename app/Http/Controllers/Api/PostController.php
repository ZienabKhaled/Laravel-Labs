<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;


class PostController extends Controller
{
    public function index ()
    {
    // Post::all();
      return PostResource::collection(Post::with('user')->get()->paginate(6));
    }

    public function show($postId)
    {
     return Post::find($postId);
    }

    public function store(StorePostRequest $request)
    {
        $path = Storage::putFile('public', $request->file('image'));
        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        $post= Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'image' => $path
        ]);
        return $post;
    }
}
