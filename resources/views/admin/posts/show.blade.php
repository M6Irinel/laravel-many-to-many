@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $post->title }}</h1>
            <p class="lead">{{ $post->description }}</p>
            <p class="lead"><strong>{{ $post->slug }}</strong></p>
            @if ($post->category)
                <p class="lead">Nome della categoria : <strong>{{ $post->category->name }}</strong></p>
                <p class="lead">Slug della categoria : <strong>{{ $post->category->slug }}</strong></p>
            @endif

            <p class="m-0"><strong>Other posts with this category :</strong></p>
            <ol>
                @if ($post->category)
                    @foreach ($post->category->posts as $posts_as_one_category)
                        <li class="m-0">{{ $posts_as_one_category->title }}</>
                    @endforeach
                @endif
                </ul>
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
