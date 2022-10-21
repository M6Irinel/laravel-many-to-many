@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $post->title }}</h1>
            <p class="lead">{{ $post->description }}</p>
            <p class="lead">{{ $post->slug }}</p>
        </div>
        <div class="container d-flex justify-content-center">
            <a class="btn btn-secondary" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
            <div>
              <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="w-100">
                  @csrf
                  @method('DELETE')
                  <input type="submit" class="btn btn-danger ml-3" href="{{ route('admin.posts.edit', $post) }}"
                      value="DELETE">
              </form>
            </div>
        </div>
    </div>
@endsection
