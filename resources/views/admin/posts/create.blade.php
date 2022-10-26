@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">

                @csrf


                <div class="form-group">
                    <label for="title">Title</label>

                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}">

                    @error('title')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="image">Image</label>

                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>

                    @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="category_id">Categoria</label>

                    <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id"
                        id="category_id">
                        <option value="">-- nessuna --</option>

                        @foreach ($categories as $category)
                            <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label class="d-block">Tags</label>

                    @foreach ($tags as $tag)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="tags[]" @if (in_array($tag->id, old('tags', []))) checked @endif
                                type="checkbox" id="tag-{{ $tag->id }}" value="{{ $tag->id }}">
                            <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                        </div>
                    @endforeach

                    @error('tags')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>


                <div class="d-flex justify-content-center">
                    <input class="btn btn-secondary" type="submit" value="CREA">
                </div>
            </form>
        </div>
    </section>
@endsection
