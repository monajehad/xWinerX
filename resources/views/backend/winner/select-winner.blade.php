@extends ('backend.layouts.app')

@section('content')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
<div class=" d-flex" style="justify-content: center;
align-items: center; margin-top:10%">
<div>
    <img class="object-cover object-center rounded" alt="winner" src="{{ asset('img/select.svg') }}">

</div>
<div style="
margin-left: 16px !important;
">
    <h3>Winner Selection</h3>

        <p>To select a winner for a campaign kindly follow the following steps.</p>

        <form method="POST" action="{{ route('campaigns.do-select-winner', ['campaignId' => $campaignId]) }}">
            @csrf
            <button type="submit" style="background:#007DFE" class="btn text-white">Select Winner</button>
        </form>
</div>
        

     
    </div>
    </div>


@endsection
