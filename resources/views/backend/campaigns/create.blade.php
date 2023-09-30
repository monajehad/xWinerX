@extends('backend.layouts.app')

@section('content')
<div class="card col-8" style="padding-left: 16px padding-top:25px; padding-bottom:50px">
   
    <div class="card-body ">
        <div class="card-title mb-4">

            <h4>Create Campaign</h4>
            </div>
    <form action="{{ route('campaigns.store') }}" class="col-10" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="target">Target</label>
            <input type="number" class="form-control" id="target" name="target" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input  class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Active" {{ old('status', $campaign->status ?? '') === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Won the Prize" {{ old('status', $campaign->status ?? '') === 'Won the Prize' ? 'selected' : '' }}>Won the Prize</option>
                <option value="Disabled by Admin" {{ old('status', $campaign->status ?? '') === 'Disabled by Admin' ? 'selected' : '' }}>Disabled by Admin</option>
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="close_campaign_after">Close Campaign After</label>
            <input type="date" class="form-control" id="close_campaign_after" name="close_campaign_after" required>
        </div> --}}
        <button type="submit" style="background: var(--transparent-primary-16, rgba(0, 171, 85, 0.16));
        color:#007B55"  class="btn  mt-3">Create</button>
    </form>
    </div>
</div>
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