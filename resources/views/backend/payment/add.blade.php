@extends ('backend.layouts.app')


@section('content')
<div class="container">
    <div class="card col-8" style="padding-left: 16px padding-top:25px; padding-bottom:50px">
        <div class="card-body ">

    <div class="d-flex  justify-content-between">
    <h3>Add a New Card</h3>
    <div>
        <a href="{{ route('billing-detail') }}" class="btn text-primary" style="    background: var(--transparent-primary-8, rgba(0, 125, 254, 0.08));"> Back</a>
        </div>
    </div>
    <form method="POST" class="col-10"{{ route('cards.store') }}>
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
        <button type="submit"  style="background: var(--transparent-primary-16, rgba(0, 171, 85, 0.16));
        color:#007B55 " class="btn mb-5 mt-4">Add Card</button>
    </form>
        </div>
</div>
</div>
@endsection
