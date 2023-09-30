@extends('frontend.layouts.app')

@section('content')

<section class="mb-20" style="background: #C8D7D9;
height: 670px;

">
    <div class="container mx-auto flex px-1 sm:px-20 py-20 md:flex-row flex-col items-center">

        <div style="border-radius: 32px !important;
        height: 480px;" class="w-50 px-4  md:pl-16 flex flex-col  items-center text-center "
>
            <img src="{{ asset('storage/'.$campaign->image ?? 'images/def.svg') }}" style="width: 100%;
            height: 100%;
            flex-shrink: 0; border-radius: 32px;
" class="card-img-top" alt="...">

            {{-- <h1 class="title-font sm:text-8xl text-4xl mb-4 font-medium text-gray-800">

                Experience a World of Prizes at Your Fingertips!

            </h1>
            <p class="mb-8 sm:text-2xl text-2xl">
                Unleash the thrill of uncertainty, and let fate guide you towards incredible surprises.
            </p>
            <div class="flex justify-center">
                <a href="{{route('show-all-campaigns' )}}"  class="inline-flex btn btn-primary">
                   
                    Discover more
                </a>
                <a href="{{route('show-all-campaigns' )}}"  class="ml-4 inline-flex btn btn-outline-secondary">
                   
                    Our Campaigns 
                </a> --}}
            {{-- </div>

            @include('frontend.includes.messages') --}}

        </div>

        <div class="flex flex-col  items-left text-left  w-50">
            <h2>{{ $campaign->name }}</h2>
            <p> {{ $campaign->description }}</p>

        </div>
       
    </div>
</section>

{{-- 
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
// $ads=App\Models\SmartAds::latest()->take(2)->get();
// dd($ads);
?>
@foreach($ads as $ad)
    <x-smart-ad-component slug="{{$ad->name}}"/>
@endforeach --}}
@endsection
@push ('after-scripts')
<script src="{{ asset('vendor/smart-ads/js/smart-banner.min.js') }}"></script>
@endpush 