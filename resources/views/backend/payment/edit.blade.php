@extends ('backend.layouts.app')


@section('content')
<div class="container">
    <div class="card col-8" style="padding-left: 16px padding-top:25px; padding-bottom:50px">
        <div class="card-body ">

    <div class="d-flex  justify-content-between">
    <h3>Edit Card</h3>
    <div>
        <a href="{{ route('billing-detail') }}" class="btn text-primary" style="    background: var(--transparent-primary-8, rgba(0, 125, 254, 0.08));"> Back</a>
        </div>
    </div>
    <!-- Card Edit Form -->
    <form method="POST" class="col-10" action="{{ route('cards.update',  $card->id) }}">
        @method('PUT') <!-- This is used to simulate a PUT request -->
        @csrf
        <!-- Card Type Input -->
        <div class="form-group">
            <label for="card_type">Card Type</label>
            <input type="text" name="card_type" id="card_type" class="form-control" value="{{ $card->card_type }}">
        </div>

        <!-- Card Number Input -->
        <div class="form-group">
            <label for="card_number">Card Number</label>
            <input type="text" name="card_number" id="card_number" class="form-control" value="{{ $card->card_number }}">
        </div>

        <!-- Card Last Four Input -->
        <div class="form-group">
            <label for="card_last_four">Card Last Four Digits</label>
            <input type="text" name="card_last_four" id="card_last_four" class="form-control" value="{{ $card->card_last_four }}">
        </div>

        <!-- Submit Button -->
        <button type="submit"  style="background: var(--transparent-primary-16, rgba(0, 171, 85, 0.16));
        color:#007B55" class="btn  mt-4 mb-5">Update</button>
    </form>
</div>
    </div>
</div>
@endsection

