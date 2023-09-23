@extends('backend.layouts.app')

@section('content')

  <!-- Add Campaign Feature -->
  <h3>Add Campaign Feature</h3>
  <form action="{{ route('campaigns.features.store', $campaign) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
          @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>
      <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
          @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>
      
      <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
          @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>
      <button type="submit" class="btn btn-primary">Add Feature</button>
  </form>
@endsection