@extends('layouts.app')

@section('title') create @endsection

@section('content')
<form method="POST" action="{{route('posts.update',['post' => $post->id])}}">
  @csrf
  @method('PUT')
  <div class="form-group mb-3">
    <label class="form-label">Title</label>
    <input name='title' type="text" class="form-control" value="{{$post->title}}">
  </div>

  <div class="form-group mb-3">
    <label class="form-label">Description</label>
    <textarea class="form-control" name="description">{{$post->description}}</textarea>
  </div>

 <div class="form-group mb-3">
    <label class="form-label">Post Creator</label>
    <select name='post_creator' class="form-control">
      @foreach($allUsers as $user)
      <option value="{{ $user->id }}" @if($user->id == $post->user_id) selected @endif >{{ $user->name }}</option>
      @endforeach
    </select>
  </div> 
  <!-- normal html comment is read while {{-- --}} comment is not read in html -->

  <button type="submit" class="btn btn-primary">Update Post</button>
</form>
@endsection