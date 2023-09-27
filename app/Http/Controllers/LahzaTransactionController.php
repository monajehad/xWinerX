<?php
// app/Http/Controllers/LahzaTransactionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\LahzaApiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LahzaTransactionController extends Controller
{
protected $lahzaBaseUri = 'https://api.lahza.io/';

protected $LahzaApiService;

public function __construct(LahzaApiService $LahzaApiService)
{
    $this->LahzaApiService = $LahzaApiService;
}

public function initializeTransaction(Request $request)
{
    $requestData = [
        'amount' => 100, // Example amount
        'mobile' => $request->input('mobile'),
        'email' => $request->input('email'),
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'currency' => 'USD',

    ];
    // Handle request data and call the service
    $response = $this->LahzaApiService->initializeTransaction($requestData);

    // Process the response and return
   // Process the response
   $responseData = $response->json();
       return redirect($responseData['data']['authorization_url']);

}

public function verifyTransaction($reference)
{
    // Call the service to verify the transaction
    $response = $this->LahzaApiService->verifyTransaction($reference);

    // Process the response and return
 // Process the response
 $responseData = $response->json();

 // Access individual fields
 $amount = $responseData['data']['amount'];
 $currency = $responseData['data']['currency'];
 $transactionDate = $responseData['data']['transaction_date'];

}

public function listTransactions(Request $request)
{
    // $apiKey = 'pk_test_alM69Plu0E0GxVvV3lTKalALxZ5uJycoO';
    //     $apiSecret = 'sk_test_2i9pABVUbABBCn28192Q5e91mVrRtGoRP';
        
    $apiKey = config('pk_test_alM69Plu0E0GxVvV3lTKalALxZ5uJycoO'); // Retrieve API key from configuration
    $apiSecret = config('sk_test_2i9pABVUbABBCn28192Q5e91mVrRtGoRP'); // Retrieve API secret from configuration

    // $client = new Client();
     // Check if the user is logged in
     if (Auth::check()) {
        $user = Auth::user(); // Get the authenticated user
        $userEmail = $user->email; // Get the user's email
    } else {
        // User is not logged in, handle as needed
        return redirect()->route('login'); // Redirect to the login page or show an error message
    }
    $queryParams = [
        'perPage' => $request->input('perPage', 50), // Default to 50 records per page
        'page' => $request->input('page', 1), // Default to the first page
        'status' => $request->input('status'), // Filter by status if provided
        'from' => $request->input('from'), // Start date filter if provided
        'to' => $request->input('to'), // End date filter if provided
        'amount' => $request->input('amount'), // Amount filter if provided
    ];
    // $response = $client->get('https://api.lahza.io/transaction', [
    //     'headers' => [
    //         'Authorization' => 'Bearer pk_test_alM69Plu0E0GxVvV3lTKalALxZ5uJycoO', // Replace with your actual secret key
    //     ],
    //     'query' => $queryParams,
    // ]);
  
    $response = Http::withBasicAuth($apiKey, $apiSecret)
    ->get('https://api.lahza.io/transaction',[ 'query' => $queryParams]);

      // Check if the request was successful
      if ($response->getStatusCode() == 200) {
        $transactionData = json_decode($response->getBody());

        // Extract and display the list of transactions
        $filteredTransactions = $transactionData->data;

            // Filter transactions where the customer's email matches the user's email
            $transactions = collect($filteredTransactions)->filter(function ($transaction) use ($userEmail) {
                return $transaction->customer->email === $userEmail;
            });
        return view('backend.payment.billing-details', [
            'transactions' => $transactions,
        ]);
    } else {
        return 'Transaction listing failed.';
    }

    // return view('transactions.index', ['transactions' => $transactions]);
}

public function fetchTransaction($id)
{
    // Call the Lahza API to fetch the transaction details
    $response = $this->LahzaApiService->fetchTransaction($id);

    // Process the response and get the transaction data
    $transaction = $response->json()['data'];

    // return view('transactions.details', compact('transaction'));
}

public function chargeAuthorization(Request $request)
{
    // Prepare the request payload
    $payload = [
        'amount' => $request->input('amount'),
        'email' => $request->input('email'),
        'authorization_code' => $request->input('authorization_code'),
        'reference' => $request->input('reference'),
        'currency' => $request->input('currency'),
        'metadata' => $request->input('metadata'),
        'queue' => $request->input('queue', false),
    ];

    // Call the Lahza API to charge the authorization
    $response = $this->LahzaApiService->chargeAuthorization($payload);

    // Process the response and return data
    $result = $response->json();

    return response()->json($result);
}
public function viewTransactionTimeline($idOrReference)
{
    // Call the Lahza API to view the transaction timeline
    $response = $this->LahzaApiService->viewTransactionTimeline($idOrReference);

    // Process the response and return data
    $timeline = $response->json()['data'];

    return view('transactions.timeline', compact('timeline'));
}

}