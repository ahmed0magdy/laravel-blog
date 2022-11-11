@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="card">
  <div class="card-header">
    Post Info
  </div>
  <div class="card-body">
    <h5 class="card-title">ID:- {{$post->id}}</h5>
    <h5 class="card-title">Title:- {{$post->title}}</h5>
    <h5 class="card-title">Description:- {{$post->description}}</h5>
  </div>
</div>
@endsection