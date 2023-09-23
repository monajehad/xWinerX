@extends('frontend.layouts.app')

@section('content')
    <h1>Campaign Details</h1>
    <img src="{{ asset('storage/'.$campaign->image ?? 'images/def.svg') }}" style="width:200px" class="card-img-top" alt="...">
    <h2>{{ $campaign->name }}</h2>
    <p>Description: {{ $campaign->description }}</p>
    <p>Target: {{ $campaign->target }}</p>
    <p>Price: {{ $campaign->price }}</p>
    <p>Close Campaign After: {{ $campaign->close_campaign_after }}</p>
    
    @if($campaign->status == 'Won the Prize' || $campaign->status == 'Disabled by Admin')
    <a href="" disabled class="btn btn-primary">closed</a>
@else
    @if(Auth::check())
        <a href="{{ route('payment', $campaign) }}" class="btn btn-primary">Participate in</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-primary">Log in to Participate</a>
    @endif
@endif
    <!-- Display Campaign Features -->
    <h2>Campaign Features</h2>
    @if ($campaign->features !== null && $campaign->features->count() > 0)
        <ul>
            @foreach ($campaign->features as $feature)
                <li>
                    {{ $feature->title }}
                    {{ $feature->description }}
                    <img src="{{ asset('storage/'.$feature->image) }}"  alt="Campaign Feature Image" style="width: 200px; height: 150px;">

                    <form action="{{ route('campaigns.features.destroy', [$campaign, $feature]) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this feature?')">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No features available.</p>
    @endif
<?php
$ads=App\Models\SmartAds::latest()->take(2)->get();
// dd($ads);
?>
@foreach($ads as $ad)
    <x-smart-ad-component slug="{{$ad->name}}"/>
@endforeach
@endsection
@push ('after-scripts')
<script src="{{ asset('vendor/smart-ads/js/smart-banner.min.js') }}"></script>
@endpush 