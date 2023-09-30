@extends('backend.layouts.app')

@section('content')
<div class="card col-8" style="padding-left: 16px padding-top:25px; padding-bottom:50px">
   
    <div class="card-body ">
        <div class="card-title mb-4 d-flex  justify-content-between">

    <h3>Edit Campaign</h3>
    <div>
        <a href="{{ route('campaigns.index') }}" class="btn text-primary" style="    background: var(--transparent-primary-8, rgba(0, 125, 254, 0.08));"> Back</a>
        </div>
    </div>
    <form class="col-10" action="{{ route('campaigns.update', $campaign) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $campaign->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $campaign->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="target">Target</label>
            <input type="number" class="form-control" id="target" name="target" value="{{ $campaign->target }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input class="form-control" id="price" name="price" value="{{ $campaign->price }}" required>
        </div>
        {{-- <div class="form-group">
            <label for="close_campaign_after">Close Campaign After</label>
            <input type="date" class="form-control" id="close_campaign_after" name="close_campaign_after" value="{{ $campaign->close_campaign_after }}" required>
        </div> --}}
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Active" {{ old('status', $campaign->status) === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Won the Prize" {{ old('status', $campaign->status) === 'Won the Prize' ? 'selected' : '' }}>Won the Prize</option>
                <option value="Disabled by Admin" {{ old('status', $campaign->status) === 'Disabled by Admin' ? 'selected' : '' }}>Disabled by Admin</option>
            </select>
        </div>
        <button type="submit" style="background: var(--transparent-primary-16, rgba(0, 171, 85, 0.16));
        color:#007B55"  class="btn  mt-4 mb-5">Update</button>
    </form>
    </div>
</div>
@endsection
