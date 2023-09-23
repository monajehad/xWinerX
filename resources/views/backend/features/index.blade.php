@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
<div class="row pt-4 pb-4 ">
    
<div class="col-md-10">
    <h3>All Features</h3>
</div>
<div class="col-md-2">

    @can('add_campaigns')
        <a href="{{ route('features.create') }}" class="btn btn-info text-white mb-3">Add New</a>
    @endcan
</div>
</div>
<table class="table table-striped ">
    <thead>
        <th colspan="7" class="pb-4">Easily manage your features</th>

    </thead>
   
    <tbody>
        <tr>
            <td class="th"> Image</td>

            <td class="th">features name</td>
            <td class="th">Description</td>
            
        
        </tr>
        @forelse ($features as $feature)
        <tr>
            <td>    <img src="{{ asset('storage/'.$feature->image) }}" width="100" height="100" class="card-img-top" alt="...">
            </td>
                <td>{{ $feature->title }}</td>
                <td>{{ $feature->description }}</td>
                
               
                <td>
                    {{-- @can('view_features') --}}
                    
                    {{-- @endcan --}}
                    {{-- @can('edit_features') --}}

                    <a href="{{ route('features.edit', $feature) }}" class="btn  btn-sm">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    {{-- @endcan --}}
                 
                    {{-- @can('delete_features') --}}

                   

                   
                    <form action="{{ route('features.destroy', $feature) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn  btn-sm" onclick="return confirm('Are you sure you want to delete this feature?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    {{-- @endcan --}}
                </td>
               
            </tr>
            @empty
            <tr>
                <td colspan="6">No active feature found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
</div>
@endsection



