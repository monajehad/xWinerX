<?php
    // app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Services\LahzaApiService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    protected $lahzaApiService;

    public function __construct(LahzaApiService $lahzaApiService)
    {
        $this->lahzaApiService = $lahzaApiService;
    }


    public function showPaymentInterface( $campaignId)
    {

        return view('backend.payment.payment-interface',compact('campaignId'));
    }
    public function processCardPayment(Request $request)
    {
        // You need to replace these values with your actual API credentials
        $apiKey = 'pk_test_alM69Plu0E0GxVvV3lTKalALxZ5uJycoO';
        $apiSecret = 'sk_test_2i9pABVUbABBCn28192Q5e91mVrRtGoRP';
        
        $cardNumber = $request->input('card_number');
        $expiryDate = $request->input('expiry_date');
        $cvv = $request->input('cvv');
        
        // Build the request payload
        $payload = [
            'card_number' => $cardNumber,
            'expiry_date' => $expiryDate,
            'cvv' => $cvv,
            // Add other required parameters
        ];
        
        // Make API request
        $response = Http::withBasicAuth($apiKey, $apiSecret)
            ->post('https://api.lahza.io/v1/payment/card', $payload);

        if ($response->successful()) {
            // Payment successful
            return redirect()->route('payment')->with('success', 'Card payment successful.');
        } else {
            // Payment failed
            return response()->json(['error' => 'Payment failed'], 500);
        }
    }
    public function processusdtpayment(Request $request)
    {
    // Get user and payment method information from the request
    $user = Auth::user(); // Assuming you're using Laravel's authentication
    $paymentMethodId = $request->input('payment_method_id'); // Assuming you have a select dropdown for payment methods
    $amount = 100; // Replace with the actual amount
    
    // Fetch payment method details from the database
    $paymentMethod = PaymentMethod::find($paymentMethodId);
    
    if (!$paymentMethod || $paymentMethod->method_type !== 'usdt') {
        return response()->json(['error' => 'Invalid payment method'], 400);
    }

    // Implement the logic to initiate the USDT payment via the Lahza API
    $client = new Client();
    $response = $client->post('https://api.lahza.io/usdt/payment', [
        'headers' => [
            'Authorization' => 'Bearer ' . $user->lahza_access_token, // Assuming you have an access token for Lahza
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'amount' => $amount,
            'usdt_address' => $paymentMethod->usdt_address,
            // Add other required parameters as per Lahza API documentation
        ],
    ]);

    // Process the response from the API
    $responseBody = json_decode($response->getBody(), true);

    if ($responseBody['status'] === 'success') {
        // Save transaction details to your database
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'currency' => 'USDT',
            // 'payment_method' => 'usdt',
            // Add other relevant fields
        ]);

        return response()->json(['message' => 'Payment successful']);
    } else {
        return response()->json(['error' => 'Payment failed'], 500);
    }
}

    public function createPaymentPage(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $amount = $request->input('amount');
        $slug = $request->input('slug');
        $metadata = [
            // ... metadata values if needed
        ];
        $redirectUrl = $request->input('redirect_url');
        $customFields = [
            // ... custom fields if needed
        ];

        $paymentPage = $this->lahzaApiService->createPaymentPage(
            $name,
            $description,
            $amount,
            $slug,
            $metadata,
            $redirectUrl,
            $customFields
        );

        if ($paymentPage) {
            // Payment page created successfully
            return response()->json(['message' => 'Payment page created successfully'], 200);
        } else {
            // Failed to create payment page
            return response()->json(['message' => 'Failed to create payment page'], 500);
        }
    }

    public function listPaymentPages()
    {
        $perPage = 50; // Specify the number of records per page
        $page = 1; // Specify the page number
        $from = null; // Specify the start timestamp if needed
        $to = null; // Specify the end timestamp if needed

        $paymentPages = $this->lahzaApiService->listPaymentPages($perPage, $page, $from, $to);

        if ($paymentPages) {
            // Successfully retrieved payment pages
            return response()->json($paymentPages, 200);
        } else {
            // Failed to retrieve payment pages
            return response()->json(['message' => 'Failed to retrieve payment pages'], 500);
        }
    }

    // app/Http/Controllers/PaymentController.php

// ... (previous code)

public function fetchPaymentPage($idOrSlug)
{
    $paymentPage = $this->lahzaApiService->fetchPaymentPage($idOrSlug);

    if ($paymentPage) {
        return response()->json($paymentPage, 200);
    } else {
        return response()->json(['message' => 'Failed to fetch payment page'], 500);
    }
}

public function updatePaymentPage(Request $request, $idOrSlug)
{
    $name = $request->input('name');
    $description = $request->input('description');
    $amount = $request->input('amount');
    $active = $request->input('active');

    $updatedPage = $this->lahzaApiService->updatePaymentPage($idOrSlug, $name, $description, $amount, $active);

    if ($updatedPage) {
        return response()->json(['message' => 'Payment page updated successfully'], 200);
    } else {
        return response()->json(['message' => 'Failed to update payment page'], 500);
    }
}

public function checkSlugAvailability($slug)
{
    $availability = $this->lahzaApiService->checkSlugAvailability($slug);

    if ($availability) {
        return response()->json(['available' => $availability['available']], 200);
    } else {
        return response()->json(['message' => 'Failed to check slug availability'], 500);
    }
}

}

?>