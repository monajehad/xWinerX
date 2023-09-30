@extends ('backend.layouts.app')


@section('content')
<div class="container">
    <h4>Edit Card</h4>

    <!-- Card Edit Form -->
    <form method="POST" class="col-6" action="{{ route('cards.update',  $card->id) }}">
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
        color:#007B55" class="btn  mt-3">Save Changes</button>
    </form>
</div>
@endsection

