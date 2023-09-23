<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    //

    public function index()
    {
        // $subscriptions = Subscription::all();
        // return view('subscriptions.index', compact('subscriptions'));

        $campaigns = Campaign::all();
        return view('backend.campaigns.index_campaigns', compact('campaigns'));
    }

    public function create()
    {
        // Load data needed for creating subscriptions (e.g., campaigns, users)
        // You may also load campaigns and users to populate dropdown/select options

        return view('subscriptions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required',
            'user_id' => 'required',
            'total_payment' => 'required|numeric',
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    public function show(Subscription $subscription)
    {
        return view('subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        return view('subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'campaign_id' => 'required',
            'user_id' => 'required',
            'total_payment' => 'required|numeric',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }

}
