@extends ('backend.layouts.app')

@section('title') campaign @endsection



@section('content')



<section class="container mb-20">

  <div class="text-left lg:w-4/4 w-full">
      <h3 style="font-weight: 700; margin-top:40px; padding-left:35px;
      " class="title-font sm:text-4xl text-3xl mb-4 font-medium ">
        My campaigns 
      </h3>
     
  </div>

<div class="row" style="padding-right: 100px; padding-left:35px;  margin-top:40px; margin-bottom:200px">
 
 @foreach ($campaigns as $campaign)
   
  <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card" >

          <img src="{{ asset('storage/'.($campaign->image ?? 'images/def.svg')) }}" style="width:100%
          height: 260px !impartant;" class="card-img-top" alt="...">
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



