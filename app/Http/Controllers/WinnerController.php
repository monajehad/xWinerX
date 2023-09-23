<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Subscription;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    //

    public function selectWinner($campaignId)
    {
        $campaign = Campaign::findOrFail($campaignId);

        // Retrieve all subscription IDs for the given campaign
        $subscriptionIds = Subscription::where('campaign_id', $campaignId)->pluck('id');

        // Create an array to store weighted probabilities
        $weightedProbabilities = [];

        // Calculate the total number of subscriptions for the campaign
        $totalSubscriptions = count($subscriptionIds);

 // Check if the number of participants equals the campaign target
 if ($totalSubscriptions === $campaign->target  || $campaign['status'] == 'Disabled by Admin') {
    // Check if a winner has already been selected for this campaign
    $existingWinner = Winner::where('campaign_id', $campaignId)->first();

    if (!$existingWinner) {
        // Randomly select one participant
        // $randomSubscription = $subscriptionIds->random();

        foreach ($subscriptionIds as $subscriptionId) {
            $subscription = Subscription::find($subscriptionId);
            $user = $subscription->user;
            $userSubscriptions = Subscription::where('user_id', $user->id)->where('campaign_id', $campaignId)->count();
            $winningProbability = $userSubscriptions / $totalSubscriptions;
            $weightedProbabilities[$subscriptionId] = $winningProbability;
        }

        // Randomly select a subscription ID based on weighted probabilities
        $randomSubscriptionId = $this->weightedRandom($weightedProbabilities);

        // Retrieve the associated user for the selected subscription
        $user = Subscription::find($randomSubscriptionId)->user;
        $campaign->status = 'Won the Prize';
        $campaign->save();
        // Insert a new record into the Winner table
        Winner::create([
            'campaign_id' => $campaignId,
            'subscription_id' => $randomSubscriptionId,
            'user_id' => $user->id,
            'winning_percentage' => $weightedProbabilities[$randomSubscriptionId],
        ]);

        return redirect()->back()->with('success', 'Winner selected successfully.');
    } else {
        return redirect()->back()->with('error', 'A winner has already been selected for this campaign.');
    }
} else {
    return redirect()->back()->with('error', 'Campaign target not reached yet.');
}
  
}

    // Helper function for weighted random selection
    private function weightedRandom($weightedProbabilities)
    {
        $totalWeight = array_sum($weightedProbabilities);
        $randomValue = mt_rand(1, $totalWeight);

        foreach ($weightedProbabilities as $key => $weight) {
            $randomValue -= $weight;
            if ($randomValue <= 0) {
                return $key;
            }
        }}
}
