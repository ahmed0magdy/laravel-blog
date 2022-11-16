@extends('layouts.app')

@section('title') create @endsection

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form method="POST" action="{{route('posts.store')}}">
  @csrf
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input name='title' type="text" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea class="form-control" name="description"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Post Creator</label>
    <select name='post_creator' class="form-control">
      @foreach($allUsers as $user)
      <option value="{{ $user->id }}" >{{ $user->name }}</option>
      @endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Create Post</button>
</form>
</div>


@endsection