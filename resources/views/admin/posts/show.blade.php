@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <h1 class="display-4">{{ $post->title }}</h1>
                    <p class="lead">{{ $post->description }}</p>
                    <p class="lead"><strong>{{ $post->slug }}</strong></p>
                    @if ($post->category)
                        <p class="lead">Nome della categoria : <strong>{{ $post->category->name }}</strong></p>
                        <p class="lead">Slug della categoria : <strong>{{ $post->category->slug }}</strong></p>
                    @endif
                </div>
                @if ($post->image)
                    <div>
                        <img src="{{ $post->image_url }}" alt="Image post">
                    </div>
                @endif
            </div>

            <p class="m-0">Tags</p>
            <ul>
                @forelse($post->tags as $tag)
                    <li>{{ $tag->name }}</li>
                    <ol>
                        @foreach ($tag->posts()->where('id', '!=', $post->id)->get() as $p)
                            <li>
                                <a href="{{ route('admin.posts.show', $p) }}">
                                    {{ $p->title }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                @empty
                    <li class="bold">-</li>
                @endforelse
            </ul>

            <p class="m-0"><strong>Other posts with this category :</strong></p>
            <ol>
                @if ($post->category)
                    @foreach ($post->category->posts as $posts_as_one_category)
                        <li class="m-0">{{ $posts_as_one_category->title }}</li>
                    @endforeach
                @endif
            </ol>
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
