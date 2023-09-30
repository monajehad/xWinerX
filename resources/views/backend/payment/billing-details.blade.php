<!-- resources/views/payment/payment-interface.blade.php -->
@extends ('backend.layouts.app')

@section('content')

<div class="container pt-4" >
  <h4>        Billing info
  </h4>
  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
  <div class="row">
  <div class="col-8 pl-2 pr-2">

  <div class="row">
    <div class="card shadow-sm">
      <div class="card-body">

        <div class="container">
          <div class="d-flex   justify-content-between">
            <div>
            <h6 style="color: var(--text-light-secondary, #637381);
            ">  Payment Methods</h6>
            </div>
            <div>
            <a href="{{ route('cards.create') }}" class="btn text-primary"> + New Card</a>
            </div>
          </div>
         
        
  
          <div class="row">

              @foreach($cards as $card)
                  <div class="col-md-6 mb-4">
                    
                      <div class="card" style="border-radius: 8px;
                      border: 1px solid var(--components-paper-outlined, rgba(145, 158, 171, 0.24));
                      ">

                          <div class="card-body">
                            {{-- <select class="btn dropdown-toggle" >
                              <option class="btn dropdown-toggle"></option>
                              <option >  <a href="{{ route('cards.edit',  $card->id) }}">Edit </a>
                              </option>
                              <option > <form action="{{ route('cards.destroy',  $card->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this card?')">Delete</button>
                            </form>
                          </option>
                              <!-- Add more country options as needed -->
                          </select> --}}
                            {{-- <div class="action-dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item"href="{{ route('cards.edit',  $card->id) }}">Edit Card</a>
                                <form action="{{ route('cards.destroy',  $card->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn dropdown-item" onclick="return confirm('Are you sure you want to delete this card?')">Delete</button>
                                  </form>
                              </div>
                            </div> --}}

                              <h5 class="card-title">{{ $card->card_type }}</h5>
                              <p> @hideCardNumber($card->card_number)</p>
                            </div>

                          <div class="card-footer">
                            <a href="{{ route('cards.edit',  $card->id) }}">Edit </a>
                            <form action="{{ route('cards.destroy',  $card->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this card?')">Delete</button>
                          </form>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
      </div>
    </div>
  </div>
  <div class="row  mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
      
        <div class="d-flex   justify-content-between">
          <div>
          <h6 style="color: var(--text-light-secondary, #637381);
          ">    Shipping Address </h6>
          </div>
          <div>
          <a href="{{ route('billing-addresses.create') }}" class="btn text-primary"> + New Billing Address</a>
          </div>
        </div>   
        
        <div class="">
     
          @foreach($user->billingAddresses as $billingAddress)
              <div class="col-md col mb-4 mt-4">
                
                  <div class="card" >

                      <div class="card-body">
                        
                        {{-- <div class="action-dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item"href="{{ route('cards.edit',  $card->id) }}">Edit Card</a>
                            <form action="{{ route('cards.destroy',  $card->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn dropdown-item" onclick="return confirm('Are you sure you want to delete this card?')">Delete</button>
                              </form>
                          </div>
                        </div> --}}
                          <p> <span style="color: var(--text-light-secondary, #637381);
                            ">Address:</span>   {{ $billingAddress->address }},
                            {{ $billingAddress->city }},
                            {{ $billingAddress->street	 }},
                            {{ $billingAddress->postal_code }}</p>
                            <p> <span style="color: var(--text-light-secondary, #637381);
                              ">Phone:</span>   {{ $billingAddress->mobile }}
                            </p>
                        </div>

                      <div class="card-footer bg-white d-flex">
                        <div>
                        <a href="{{  route('billing-addresses.edit', $billingAddress->id) }} "class="text-success btn">Edit </a>
                        </div>
                        <div>
                        <form action="{{ route('billing-addresses.destroy', $billingAddress->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn text-danger" onclick="return confirm('Are you sure you want to delete this card?')">Delete</button>
                          </form>
                        </div>
                      </div>
                  </div>
              </div>
              <hr class="dashed-line" style=" border: none;
              border-top: 1px dashed #999; /* Adjust color and style as needed */
              margin: 10px 0; ">

          @endforeach

      </div>
      </div>
    </div>
  </div>

  </div>
  <div class="col-4 pl-2 pr-2">
    Invoices
    <div class="row">
      <div class="card shadow-sm">

        <div class="card-body">
          {{-- @foreach($transactions as $transaction)
          <li>
              Transaction ID: {{ $transaction['id'] }}<br>
              Amount: {{ $transaction['amount'] }}<br>
              Status: {{ $transaction['status'] }}<br>
              <!-- Add more transaction details as needed -->
          </li>
      @endforeach --}}
          {{-- <div class="container">
            <h1>List of Transactions</h1>
    
            @if ($transactions->isEmpty())
                <p>No transactions found for this user.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Transaction Date</th>
                            <th>Amount</th>
                            <!-- Add more table headings as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->transaction_date }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <!-- Add more table cells as needed -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div> --}}
        </div>

      </div>
    </div>
  </div>
  </div>
</div>

@endsection
