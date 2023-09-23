<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
       // Get the visitor's IP address
       $ipAddress = $request->ip();

       // Use ipinfo.io API to get location information based on the IP address
       $response = Http::get("https://ipinfo.io/{$ipAddress}/json");

       // Parse the JSON response
       $locationData = $response->json();
// dd($locationData);
       // Extract country and continent information
       $country = $locationData['country'] ?? null;
       $continent = $locationData['continent'] ?? null;

       // Insert the visitor data into the 'visitors' table
       DB::table('visitors')->insert([
           'ip_address' => $ipAddress,
           'user_agent' => $request->userAgent(),
           'visited_at' => now(),
           'country' => $country,
           'continent' => $continent,
       ]);

       return $next($request);
   }
}
