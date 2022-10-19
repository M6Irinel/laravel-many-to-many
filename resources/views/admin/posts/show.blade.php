@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">{{$post->title}}</h1>
      <p class="lead">{{$post->description}}</p>
      <p class="lead">{{$post->shug}}</p>
    </div>
    <div class="container d-flex justify-content-center">
        <a class="btn btn-secondary" href="{{route('admin.posts.edit', $post)}}">EDIT</a>
        <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger ml-3" href="{{route('admin.posts.edit', $post)}}" value="ELIMINA">
        </form>
    </div>
  </div>

@endsection