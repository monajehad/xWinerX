@extends('backend.layouts.app')

@section('content')
    <h1>Edit Feature</h1>

    <form action="{{ route('features.update', $feature) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $feature->title }}" required>
        </div>
        <div class="form-group">
            <label for="name">Direction</label>
            <input type="text" class="form-control" id="direction" name="direction" value="{{ $feature->direction }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $feature->description }}</textarea>
        </div>
        
      
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
