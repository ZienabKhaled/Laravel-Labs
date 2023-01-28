<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    private static $allPosts= [
        [
            'id' => 1,
            'title' => 'laravel',
            'description' => 'hello this is laravel post',
            'posted_by' => 'Ahmed',
            'created_at' => '2022-01-28 10:05:00',
        ],
        [
            'id' => 2,
            'title' => 'php',
            'description' => 'hello this is php post',
            'posted_by' => 'Mohamed',
            'created_at' => '2022-01-30 10:05:00',
        ],
        [
            'id' => 3,
            'title' => 'CSS',
            'description' => 'CSS is the styling of a web page ',
            'posted_by' => 'Zienab',
            'created_at' => '2023-01-28 21:58:00',
        ],
    ];
private static $allposts = [];
public function __construct()
{
    self:: $allPosts = [
        [
            'id' => 1,
            'title' => 'laravel',
            'description' => 'hello this is laravel post',
            'posted_by' => 'Ahmed',
            'created_at' => '2022-01-28 10:05:00',
        ],
        [
            'id' => 2,
            'title' => 'php',
            'description' => 'hello this is php post',
            'posted_by' => 'Mohamed',
            'created_at' => '2022-01-30 10:05:00',
        ],
        [
            'id' => 3,
            'title' => 'CSS',
            'description' => 'CSS is the styling of a web page ',
            'posted_by' => 'Zienab',
            'created_at' => '2023-01-28 21:58:00',
        ],
    ];
}


    public function index()
    {
        return view('posts.index',[
            'posts' => self::$allPosts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return view('posts.index',[
            'posts' => self::$allPosts,
        ]);
    }

    public function show($postId)
    {

        return view('posts.show' ,['posts' =>self::$allPosts ],['postId'=> $postId]);
    }

    public function edit($postId)
    {

        return view('posts.update',['posts' =>self::$allPosts ],['postId'=> $postId]);
}
}
