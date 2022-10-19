@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <form action="{{ route('admin.posts.store') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="shug">Shug</label>
                    <input type="text" class="form-control" id="shug" name="shug"
                        value="{{ old('shug') }}">
                </div>

                <div class="d-flex justify-content-center">
                    <input class="btn btn-secondary" type="submit" value="CREA">
                </div>
            </form>
        </div>
    </section>
@endsection
