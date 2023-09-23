@extends('backend.layouts.app')

@section('content')
    <h1>Create Feature</h1>

    <form action="{{ route('features.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="name">Direction</label>
            <input type="text" class="form-control" id="direction" name="direction" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
       
        {{-- <div class="form-group">
            <label for="close_campaign_after">Close Campaign After</label>
            <input type="date" class="form-control" id="close_campaign_after" name="close_campaign_after" required>
        </div> --}}
        <button type="submit" class="btn btn-primary">Create</button>
    </form>


     {{-- <!-- Add Campaign Feature -->
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
     </form> --}}
@endsection