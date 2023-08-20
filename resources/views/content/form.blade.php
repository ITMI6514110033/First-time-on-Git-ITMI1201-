@extends('master');

@section('title', 'Content CRUD');

@section('content')
    @if (empty($contents->id))
        <h1>Create Content</h1>
    @else
        <h1>Edit Content</h1>
    @endif

    <form action="{{ empty($contents->id) ? url('/content') : url('/content/' . $contents->id) }}" method="post">

        @if (!empty($contents->id))
            @method('put')
        @endif

        @csrf

        <div class="mb-3">
            <label for="topic">Topic</label>

            <input type="text" class="form-control" id="topic" name="topic"
                value="{{ old('topic', $contents->topic) }}">

            @error('topic')
                <div class="invalid-feedback d-block">{{ $errors->first('topic') }}</div>
            @enderror

        </div>


        <div class="mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $contents->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback
                    d-block">{{ $errors->first('description') }}</div>
            @enderror

        </div>
        <div class="mb-3">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags"
                value="{{ old('tags', $contents->tags) }}">
            @error('tags')
                <div class="invalid-feedback
                    d-block">{{ $errors->first('tags') }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="links">Links</label>
            <input type="text" class="form-control" id="links" name="links"
                value="{{ old('links', $contents->links) }}">
            @error('links')
                <div class="invalid-feedback
                    d-block">{{ $errors->first('links') }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Save</button>
        <a href="{{ url('/content') }}"" role="button" class="btn btn-sm btn-danger">Back</a>
    </form>
@endsection
