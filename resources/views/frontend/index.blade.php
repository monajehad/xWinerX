@extends('frontend.layouts.app')

@section('title') {{app_name()}} @endsection

@section('content')

<section class="bg-gray-100 mb-20">
    <div class="container mx-auto flex px-1 sm:px-20 py-20 md:flex-row flex-col items-center">

        <div class="lg:flex-grow md:w-1/2 px-4 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
            <h1 class="title-font sm:text-8xl text-4xl mb-4 font-medium text-gray-800">

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
                </a>
            </div>

            @include('frontend.includes.messages')

        </div>

        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded" alt="hero" src="{{ asset('img/header-img.png') }}">
        </div>
       
    </div>
</section>

<section class="container mb-20">

    <?php 
         $lastFeatures = App\Models\Feature::latest()->take(4)->get();
        ?>
        @foreach ($lastFeatures as $feature)
            
        
    <div class="grid grid-cols-2 sm:grid-cols-1 gap-4 p-5">
        <div class="text-left lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">
               {{$feature->title}}
            </h1>
            <p class="mb-8 leading-relaxed">
                {{$feature->description}}
            </p>
        </div>
     
        <div class="p-3 sm:p-10 rounded-lg">
            <img src="{{ asset('storage/'.$feature->image) }}" alt="Diverse Prizes">
        </div>
    </div>
   @endforeach
    {{-- <div class="grid grid-cols-2 sm:grid-cols-1 gap-4 p-5">
        <div class="p-3 sm:p-10 rounded-lg">
            <img src="https://placehold.co/600x400" alt="Diverse Prizes">
        </div>

        <div class="text-left lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">
                Diverse Prizes
            </h1>
            <p class="mb-8 leading-relaxed">
                Our platform offers a wide range of prizes, from cash rewards to luxurious vacations, electronics, gift cards, and more. Participants have the chance to win exciting and valuable rewards, making every spin an adventure with endless possibilities.
            </p>
        </div>
       
    </div>
<div class="grid grid-cols-2 sm:grid-cols-1 gap-4 p-5">
        <div class="text-left lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">
                Diverse Prizes
            </h1>
            <p class="mb-8 leading-relaxed">
                Our platform offers a wide range of prizes, from cash rewards to luxurious vacations, electronics, gift cards, and more. Participants have the chance to win exciting and valuable rewards, making every spin an adventure with endless possibilities.
            </p>
        </div>
        <div class="p-3 sm:p-10 rounded-lg">
            <img src="https://placehold.co/600x400" alt="Diverse Prizes">
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-1 gap-4 p-5">
        <div class="p-3 sm:p-10 rounded-lg">
            <img src="https://placehold.co/600x400" alt="Diverse Prizes">
        </div>
        
        <div class="text-left lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">
                Diverse Prizes
            </h1>
            <p class="mb-8 leading-relaxed">
                Our platform offers a wide range of prizes, from cash rewards to luxurious vacations, electronics, gift cards, and more. Participants have the chance to win exciting and valuable rewards, making every spin an adventure with endless possibilities.
            </p>
        </div>
        --}}
    </div>
</section>


<section class="container mb-20">
    <div class="mx-auto flex px-5 py-10 sm:py-24 items-center justify-center flex-col">
        <div class="p-3 sm:p-10 rounded-lg">
            <img src="https://placehold.co/1080x240" alt="Advertisment">
        </div>
    </div>
</section>

<section class="container mb-20">

    <div class="text-left lg:w-4/4 w-full flex justify-content-between ">
      <div>  <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">
            Diverse Prizes
        </h1>
      </div>
       <div> <a href="{{route('show-all-campaigns' )}}"  class="btn "> See all  </a></div>
    </div>

<div class="row">
    <?php 
    $campaigns = App\Models\Campaign::latest()->take(6)->get();
   ?>
   @foreach ($campaigns as $campaign)
     
    <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="card">

            <img src="{{ asset('storage/'.($campaign->image ?? 'images/def.svg')) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h3>{{$campaign->name}}</h3>
              <p class="card-text">{{$campaign->description}}</p>
            <div class="d-inline-flex">

              <div class="d-flex justify-content-start">
              
                <span class="badge rounded-pill text-bg-light">
                    <i class="fa-solid fa-user-group"></i>
                    {{$campaign->target}}
                </span>
              </div>
              <div class="d-flex justify-content-start">
                <span class="badge rounded-pill text-bg-warning"> 
                    <i class="fa-solid fa-clock"></i>
                    {{ $campaign->target-$campaign->subscribers->count() }}
                </span>

              </div>

            </div>
              <div class="">
                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 25%"></div>
                  </div>
              </div>
              <div class="mt-3"> <a href="{{ route('campaigns.show', $campaign) }}"   class=" text-primary "> Get started  </a></div>

            </div>
          </div>
    </div>

@endforeach


</div>
   
</section>

@endsection