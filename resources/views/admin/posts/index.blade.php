@extends('layouts.app')

@section('content')
    <section>
        <div class="container d-flex justify-content-between">
            <div>
                <h1>Posts</h1>
            </div>
            <div>
                <a class="btn btn-success" href="{{route('admin.posts.create')}}">CREATE NEW POST</a>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Shug</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->shug }}</td>
                            <td>
                                <a type="button" class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">Look!</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
