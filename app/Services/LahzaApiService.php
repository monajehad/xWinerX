<?php
    

// app/Services/LahzaApiService.php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class LahzaApiService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl = 'https://api.lahza.io';


    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.lahza.io/',
        ]);
        // $this->apiKey = 'sk_test_2i9pABVUbABBCn28192Q5e91mVrRtGoRP'; // Replace with your actual secret key
    }

    public function createPaymentPage($name, $description, $amount, $slug, $metadata = [], $redirectUrl = null, $customFields = [])
    {
        $requestData = [
            'name' => $name,
            'description' => $description,
            'amount' => $amount,
            'slug' => $slug,
            'metadata' => $metadata,
            'redirect_url' => $redirectUrl,
            'custom_fields' => $customFields,
        ];

        $response = $this->client->post('page', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
                'Content-Type' => 'application/json',
            ],
            'json' => $requestData,
        ]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody(), true);
        } else {
            // Handle error case
            return null;
        }
    }

    public function listPaymentPages($perPage = 50, $page = 1, $from = null, $to = null)
    {
        $queryParams = [
            'perPage' => $perPage,
            'page' => $page,
            'from' => $from,
            'to' => $to,
        ];

        $response = $this->client->get('page', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
            ],
            'query' => $queryParams,
        ]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody(), true);
        } else {
            // Handle error case
            return null;
        }
    }

    public function fetchPaymentPage($idOrSlug)
{
    $response = $this->client->get("page/{$idOrSlug}", [
        'headers' => [
            'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
        ],
    ]);

    if ($response->getStatusCode() === 200) {
        return json_decode($response->getBody(), true);
    } else {
        // Handle error case
        return null;
    }
}

public function updatePaymentPage($idOrSlug, $name, $description, $amount, $active)
{
    $requestData = [
        'name' => $name,
        'description' => $description,
        'amount' => $amount,
        'active' => $active,
    ];

    $response = $this->client->put("page/{$idOrSlug}", [
        'headers' => [
            'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
            'Content-Type' => 'application/json',
        ],
        'json' => $requestData,
    ]);

    if ($response->getStatusCode() === 200) {
        return json_decode($response->getBody(), true);
    } else {
        // Handle error case
        return null;
    }
}

public function checkSlugAvailability($slug)
{
    $response = $this->client->get("page/check_slug_availability/{$slug}", [
        'headers' => [
            'Authorization' => 'Bearer ' . $this->apiKey,
        ],
    ]);

    if ($response->getStatusCode() === 200) {
        return json_decode($response->getBody(), true);
    } else {
        // Handle error case
        return null;
    }
}

public function initializeTransaction($data)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/transaction/initialize', $data);
    }

    public function verifyTransaction($reference)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
        ])->get($this->baseUrl . '/transaction/verify/' . $reference);
    }
    public function listTransactions($perPage, $page, $customer, $status, $from, $to, $amount)
{
    return Http::withHeaders([
        'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
    ])->get("$this->baseUrl/transaction", [
        'perPage' => $perPage,
        'page' => $page,
        'customer' => $customer,
        'status' => $status,
        'from' => $from,
        'to' => $to,
        'amount' => $amount,
    ]);
}

public function fetchTransaction($id)
{
    return Http::withHeaders([
        'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
    ])->get("$this->baseUrl/transaction/$id");
}
public function chargeAuthorization($payload)
{
    return Http::withHeaders([
        'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
        'Content-Type' => 'application/json',
    ])->post("$this->baseUrl/transaction/charge_authorization", $payload);
}
public function viewTransactionTimeline($idOrReference)
{
    return Http::withHeaders([
        'Authorization' => 'Bearer ' . config('app.lahza_secret_key'),
    ])->get("$this->baseUrl/transaction/timeline/$idOrReference");
}

}
