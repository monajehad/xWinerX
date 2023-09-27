@extends ('backend.layouts.app')


@section('content')
<div class="container">
    <h4>Add a New Card</h4>
    <form method="POST" class="col-6"{{ route('cards.store') }}>
        @csrf
        <div class="form-group">
            <label for="card_type">Card Type</label>
            <input type="text" class="form-control" id="card_type" name="card_type" required>
        </div>
        <div class="form-group">
            <label for="card_number">Card Number</label>
            <input type="text" class="form-control" id="card_number" name="card_number" required>
        </div>
        {{-- <div class="form-group">
            <label for="card_last_four">Last Four Digits</label>
            <input type="text" class="form-control" id="card_last_four" name="card_last_four" required>
        </div> --}}
        <button type="submit" class="btn btn-primary mt-3">Add Card</button>
    </form>
</div>
@endsection
