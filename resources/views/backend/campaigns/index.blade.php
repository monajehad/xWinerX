@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
<div class="row pt-4 pb-4 ">
    
<div class="col-md-10">
    <h3>All Campaigns</h3>
</div>
<div class="col-md-2">

    @can('add_campaigns')
        <a href="{{ route('campaigns.create') }}" class="btn btn-info text-white mb-3">Add New</a>
    @endcan
</div>
</div>
<table class="table table-striped ">
    <thead>
        <th colspan="7" class="pb-4">Easily manage your Customers</th>

    </thead>
   
    <tbody>
        <tr>
            <td class="th">Campaign name</td>
            <td class="th">Targeted participants</td>
            <td class="th">Joined participants</td>
            <td class="th">Remaining participants</td>
            <td class="th">Amount Paid</td>
            <td class="th">Status</td>
            <td class="th">Features</td>

            <td class="th">Actions</td>
        
        </tr>
        @forelse ($campaigns as $campaign)
        <tr>
                <td>{{ $campaign->name }}</td>
                <td>{{ $campaign->target }}</td>
                <td>{{ $campaign->subscribers->count() }}</td>
                <td>{{ $campaign->target-$campaign->subscribers->count() }}</td>
                <td>{{ $campaign->price }}</td>
                <td> 
                     @if($campaign->status == 'Won the Prize')
                    <span class="btn btn-primary light" style="
                        background: #28C76F26;
                        border: #28C76F26;
                        color: #28C76F;
                    ">{{ $campaign->status }}</span>
                    @elseif($campaign->status == 'Disabled by Admin')
                    <span class="btn btn-primary light" style="
                    background: #FF5C0026;
                    border: #FF5C0026;
                    color: #FF5C00;
                ">{{ $campaign->status }}</span>
                @else 
                    <span class="btn btn-primary light" style="
                        background: #00B8D929;
                        border: #00B8D929;
                        color: #006C9C;
                    ">{{ $campaign->status }}</span>
                    @endif
                </td>
                <td>  <a href="{{ route('campaigns.features-create', $campaign) }}" class="btn  btn-sm">
                    Add
                </a></td>
                <td>
                    @can('view_campaigns')
                    <a href="{{ route('campaigns.show', $campaign) }}" class="btn  btn-sm">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    @endcan
                    @can('edit_campaigns')

                    <a href="{{ route('campaigns.edit', $campaign) }}" class="btn  btn-sm">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    @endcan
                    <a href="{{ route('campaigns.do-select-winner', $campaign) }}" class="btn  btn-sm">
                        <i class="fa-solid fa-award"></i>
                    </a>
                    @can('delete_campaigns')

                   

                   
                    <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this campaign?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    @endcan
                </td>
               
            </tr>
            @empty
            <tr>
                <td colspan="6">No active campaigns found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
</div>
@endsection



