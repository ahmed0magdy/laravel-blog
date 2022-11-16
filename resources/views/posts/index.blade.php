@extends('layouts.app')
@section('title') Index @endsection
@section('content')
<div class="container">
  <div class="text-center">
  <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
</div>
<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
      <td>{{$post['id']}}</td>
      <td>{{$post->title}}</td>
      {{-- <!-- <td>{{$post['title']}}</td> -->
      <!-- <td>{{$post['posted_by']}}</td> -->
      <!-- <td>{{$post->user ? $post->user->name :'Undefined'}}</td> to stop null-->
      <!-- <td>{{$post->user ?? $post->user->name}}</td> null coaelsing operator-->
      <!-- @dd($post->user, $post->user())
      difference is we can chain on user()->where('name','Ahmed') --> --}}
      <td>{{$post->user?->name }}</td>
      <td>{{$post->created_at->format('Y-m-d')}}</td>
      <td>
        <!-- <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a> -->
        <!-- with associative array , 'post' from url-->
        <a href="{{route('posts.show', ['post'=> $post->id])}}" class="btn btn-info">View</a>
        <!-- <a href="/posts/{{$post['id']}}" class="btn btn-info">View</a> -->
        <a href="{{route('posts.edit', ['post'=> $post->id])}}" class="btn btn-primary">Edit</a>
        <form style="display: inline ;" action="{{route('posts.destroy', ['post'=> $post->id])}}" method="post"> {{-- alert before delete should be made --}}
          @csrf
          @method('Delete')
          <button type='submit' class="btn btn-danger">Delete</button>
        </form>
    </tr>
    @endforeach

  </tbody>
</table>
</div>


@endsection