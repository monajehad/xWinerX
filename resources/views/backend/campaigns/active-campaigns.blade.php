@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
<div class="row pt-4 pb-4">
    
<div class="col-md-10">
    <h3>Active Campaigns</h3>
</div>
<div class="col-md-2">

    {{-- @can('add_campaigns')
        <a href="{{ route('campaigns.create') }}" class="btn btn-success mb-3">Add New</a>
    @endcan --}}
</div>
</div>
    <table class="table table-striped ">
        <thead>
            <th colspan="7" class="pb-4">Active  Campaigns</th>

        </thead>
        <tbody>
            <tr>
                <td class="th">Campaign name</td>
                <td class="th">Targeted participants</td>
                <td class="th">Joined participants</td>
                <td class="th">Remaining participants</td>
                <td class="th">Amount Paid</td>
                <td class="th">Status</td>
                <td class="th">Actions</td>
            
            </tr>
            @forelse ($activeCampaigns as $campaign)
            <tr>
                    <td>{{ $campaign->name }}</td>
                    <td>{{ $campaign->target }}</td>
                    <td>{{ $campaign->subscribers->count() }}</td>
                    <td>{{ $campaign->target-$campaign->subscribers->count() }}</td>
                    <td>{{ $campaign->price }}</td>
                    <td>
                        <span class="btn btn-primary light" style="
                            background: #00B8D929;
                            border: #00B8D929;
                            color: #006C9C;
                        ">{{ $campaign->status }}</span>
                    </td>
                   
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



