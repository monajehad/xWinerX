<?php
// app/Http/Controllers/LahzaTransactionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\LahzaApiService;


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
    // Get query parameters from the request
    $perPage = $request->input('perPage', 50);
    $page = $request->input('page', 1);
    $customer = $request->input('customer');
    $status = $request->input('status');
    $from = $request->input('from');
    $to = $request->input('to');
    $amount = $request->input('amount');

    // Call the Lahza API to list transactions
    $response = $this->LahzaApiService->listTransactions($perPage, $page, $customer, $status, $from, $to, $amount);

    // Process the response and return data
    $transactions = $response->json();

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