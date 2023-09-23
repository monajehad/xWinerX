

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $currentWeekNewUsers }}</div>
                <div>New customers</div>
                <div class="progress progress-white progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{ $dailyActiveUsersCount }} </div>
                <div>Daily Active Users</div>
                <div class="progress progress-white progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{$closedCampaignsCount}}</div>
                <div>Closed Campaigns </div>
                <div class="progress progress-white progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{$activeCampaignsCount}}</div>
                <div>Active Campaigns </div>
                <div class="progress progress-white progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body">
                <div class="fs-4 fw-semibold">{{$newCampaignsCount}}</div>
                <div>New Campaigns </div>
                <div class="progress progress-white progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row-->

<div class="container">
    <div class="row" style="height: 500px">
        <h1>Website Visits Chart</h1>

    <div class="col-lg-8 col-md-8 col-sm-12 card" > 
        <div class="card-body">
             {!! $chart->container() !!}
        </div>
       
    </div>
<div class="col-lg-4 col-md-4 col-sm-12"> 
  <!-- Insert the chart container -->
  {!! $chartPie->container() !!}

 
</div>

</div>
<div class="row p-4 mt-5">
    <h3 class="mb-4"> Recent Campaigns </h3>
    <?php 
    $campaigns = App\Models\Campaign::latest()->take(3)->get();
   ?>
   @foreach ($campaigns as $campaign)
     
    <div class="col-lg-4 col-md-4 col-sm-12">
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
              <div class="mt-3"> <a href="{{ route('campaigns.show', $campaign) }}"   class=" text-primary "> View details  </a></div>

            </div>
          </div>
    </div>

@endforeach


</div>
</div>


{{-- 
<div class="row">
    <div class="col-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-primary text-white p-3 me-3">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div>
                    <div class="fs-6 fw-semibold text-primary">$1.999,50</div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">Widget title</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2">
                <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="#"><span class="small fw-semibold">View More</span>
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-info text-white p-3 me-3">
                    <i class="fa-solid fa-laptop"></i>
                </div>
                <div>
                    <div class="fs-6 fw-semibold text-info">$1.999,50</div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">Widget title</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2">
                <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="#"><span class="small fw-semibold">View More</span>
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-warning text-white p-3 me-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div>
                    <div class="fs-6 fw-semibold text-warning">$1.999,50</div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">Widget title</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2">
                <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="#"><span class="small fw-semibold">View More</span>
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-6 col-lg-3">
        <div class="card mb-4">
            <div class="card-body p-3 d-flex align-items-center">
                <div class="bg-danger text-white p-3 me-3">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div>
                    <div class="fs-6 fw-semibold text-danger">$1.999,50</div>
                    <div class="text-medium-emphasis text-uppercase fw-semibold small">Widget title</div>
                </div>
            </div>
            <div class="card-footer px-3 py-2">
                <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center" href="#"><span class="small fw-semibold">View More</span>
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row--> --}}