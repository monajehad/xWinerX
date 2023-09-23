{{-- @extends ('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ __($module_title) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            <x-slot name="toolbar">
                <x-buttons.create route='{{ route("backend.$module_name.create") }}' title="{{__('Create')}} {{ ucwords(Str::singular($module_name)) }}" />

                <div class="btn-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href='{{ route("backend.$module_name.trashed") }}'>
                                <i class="fas fa-eye-slash"></i> View trash
                            </a>
                        </li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                    </ul>
                </div>
            </x-slot>
        </x-backend.section-header>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('labels.backend.users.fields.name') }}</th>
                                <th>{{ __('labels.backend.users.fields.email') }}</th>
                                <th>{{ __('labels.backend.users.fields.status') }}</th>
                                <th>{{ __('labels.backend.users.fields.roles') }}</th>
                                <th class="text-end">{{ __('labels.backend.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-end">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push ('after-styles')
<!-- DataTables Core and Extensions -->
<link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">

@endpush

@push ('after-scripts')
<!-- DataTables Core and Extensions -->
<script type="module" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

<script type="module">
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
        responsive: true,
        ajax: '{{ route("backend.$module_name.index_data") }}',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'user_roles',
                name: 'user_roles'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>
@endpush
 --}}


@extends('backend.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
<div class="row pt-4 ">
    
<div class="col-md-10">
    <h3>All Customers </h3>
</div>
<div class="col-md-2">

    @can('add_campaigns')
        <a href="{{ route("backend.users.create") }}" class="btn btn-success mb-3">Add New</a>
    @endcan
</div>
</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>User name</th>
                <th>Mobile</th>
                <th>2-FA</th>
                <th>Status</th>
                <th>Last Login</th>
                <th>Actions</th>

                
                
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td></td>
                    <td>

                    {!! $user->status_label !!}
                </td>
                    <td>{{ $user->profile->last_login  ??''}}</td>
                    <td>
                        <a href="{{route('backend.users.show', $user)}}" class="btn  btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.show')}}"> 
                            <i class="fa-regular fa-eye"></i></a>
                        @can('edit_users')
                        <a href="{{route('backend.users.edit', $user)}}" class="btn  btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.edit')}}">  <i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="{{route('backend.users.changePassword', $user)}}" class="btn  btn-sm mt-1" data-toggle="tooltip" title="{{__('labels.backend.changePassword')}}"><i class="fas fa-key"></i></a>
                        {{-- @if ($user->status != 2)
                        <a href="{{route('backend.users.block', $user)}}" class="btn btn-danger btn-sm mt-1" data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.block')}}" data-confirm="Are you sure?"><i class="fas fa-ban"></i></a>
                        @endif
                        @if ($user->status == 2)
                        <a href="{{route('backend.users.unblock', $user)}}" class="btn btn-info btn-sm mt-1" data-method="PATCH" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.unblock')}}" data-confirm="Are you sure?"><i class="fas fa-check"></i></a>
                        @endif --}}
                        <a href="{{route('backend.users.destroy', $user)}}" class="btn  btn-sm mt-1" data-method="DELETE" data-token="{{csrf_token()}}" data-toggle="tooltip" title="{{__('labels.backend.delete')}}" data-confirm="Are you sure?"> <i class="fa-solid fa-trash"></i></a>
                        @if ($user->email_verified_at == null)
                        <a href="{{route('backend.users.emailConfirmationResend', $user->id)}}" class="btn btn-primary btn-sm mt-1" data-toggle="tooltip" title="Send Confirmation Email"><i class="fas fa-envelope"></i></a>
                        @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection



