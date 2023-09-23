@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>Website Visits Chart</h1>
        {!! $chart->container() !!}
        {!! $chart->script() !!} <!-- Include the chart's JavaScript code here -->
    </div>
@endsection