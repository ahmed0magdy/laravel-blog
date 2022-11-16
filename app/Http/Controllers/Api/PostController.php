<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
        
    }

    public function show($postId)
    {
        $post = Post::find($postId);
        // return [
        //     'id'=> $post->id,
        //     'mobile_title'=> $post->title,
        //     'description' => $post->description
        // ]; 
        //use post resource
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'description'=> $request->description,
            'user_id'=> $request->user_id
        ]);

        // return [
        //     'id'=> $post->id,
        //     'mobile_title'=> $post->title,
        //     'description' => $post->description,
        //     'post creator'=>$post->user_id
        // ]; 


        return new PostResource($post);
    }
}
