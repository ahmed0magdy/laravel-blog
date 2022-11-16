<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Descriptor\Descriptor;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all();
        // dd($allPosts);
        // $allPosts = [
        //     ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
        //     ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
        // ];

        return view('posts.index', ['posts' => $allPosts]);
    }

    public function showWithoutModelBinding($postId)
    {
        $Singlepost = Post::findorFail($postId);
        // $post = Post::where('id', $postId)->first();
        // $post = Post::where('title', 'Laravel for beginners')->get();
        return view('posts.show', ['post' => $Singlepost]);
    }

    //Route Model Binding

    public function show(POST $post)
    {
        // dd($post);

        return view('posts.show', ['post' => $post]);
    }




    public function create()
    {
        $allUsers = User::all();
        return view('posts.create', ['allUsers' => $allUsers]);
    }


    public function store(StorePostRequest $request)
    {
        //resolve request through service container #1
        //you can put as parameter Request $request known as service container which uses dependency injection
        //dd($request)
        //$title=$request->title
        //$description=$request->description

        //validators are in make:request controller this is just a sample
        // request()->validate([
        //         'title'=> ['required','min:3'],
        //         'description'=> ['required', 'min:5']
        //     ],[
        //         'title.required'=> 'custom message like title is required',
        //         'title.min' => 'override title min message'
        //         ]

        // );


        //need fillable to avoid csrf #2
        $data = request()->all();
        Post::create([
            'title' => request()->title, //bec request returns object
            'description' => $data['description'], //bec data is array
            'user_id' => $data['post_creator']
        ]);


        //another method doesn't need fillable #3
        // $title= request()->title;
        // $description = request()->description;
        // $post_creator = request()->post_creator;
        // $post = new Post;
        // $post->title= $title;
        // $post->description = $description;
        // $post->user_id = $post_creator;
        // $post->save();


        // dd($data);
        // return redirect()->route('posts.index');
        // return redirect(route('posts.index'));
        return to_route('posts.index');
    }

    public function editWithoutModelBinding($postId)
    {
        $allUsers = User::all();
        // dd($postId);
        $Singlepost = Post::findorFail($postId);
        // dd($Singlepost);
        return view('posts.edit', ['post' => $Singlepost, 'allUsers' => $allUsers]);
    }
    public function edit(POST $post)
    { //route model binding
        $allUsers = User::all();
        return view('posts.edit', ['post' => $post, 'allUsers' => $allUsers]);
    }

    public function update($postId, Request $request)
    {
        $Singlepost = Post::findorFail($postId);
        // dd($Singlepost);
        $Singlepost->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator
        ]);
        return redirect()->route('posts.index');
    }


    public function destroy($postId)
    {
        POST::where('id', $postId)->delete(); //in single query but model events can be a problem
        // $Singlepost = Post::findorFail($postId);
        // $Singlepost->delete();

        return redirect()->route('posts.index');
    }
}
