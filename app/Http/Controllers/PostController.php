<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = [
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
        ];
        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return 'insert in database';
    }

    public function show($postId)
    {
        $allPosts = [
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
        ];
        return view('posts.show' ,['posts' =>$allPosts ],['postId'=> $postId]);
    }

    public function edit($postId)
    {
        $allPosts = [
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
        ];
        return view('posts.update',['posts' =>$allPosts ],['postId'=> $postId]);
}
}
