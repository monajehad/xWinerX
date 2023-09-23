<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Campaign;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return view('backend.campaigns.index', compact('campaigns'));
    }
    public function allCampaigns()
    {
        $campaigns = Campaign::all();
        return view('frontend.index_campaigns', compact('campaigns'));
    }
    public function myCampaigns()
    {
        $user = Auth::user();

        // Retrieve the campaigns associated with the user's subscriptions
        $userSubscriptions = Subscription::where('user_id', $user->id)
            ->with('campaign') // Load the associated campaign
            ->get();
    
        // Extract the campaigns from the user's subscriptions
        $campaigns = $userSubscriptions->pluck('campaign')->unique();
        return view('backend.campaigns.index_campaigns', compact('campaigns'));
    }
    public function activeCampaigns()
{
    $user = Auth::user();

        // Retrieve the campaigns associated with the user's subscriptions
        $userSubscriptions = Subscription::where('user_id', $user->id)
            ->with('campaign') // Load the associated campaign
            ->get();
    
        // Extract the campaigns from the user's subscriptions
        $activeCampaigns = $userSubscriptions->pluck('campaign')->where('status', 'Active')->unique();
    // $activeCampaigns = Campaign::where('status', 'Active')->get();

    return view('backend.campaigns.active-campaigns', compact('activeCampaigns'));
}
public function completedCampaigns()
{

    $user = Auth::user();

    // Retrieve the campaigns associated with the user's subscriptions
    $userSubscriptions = Subscription::where('user_id', $user->id)
    ->with('campaign') // Load the associated campaign
    ->get();

// Extract the campaigns from the user's subscriptions
$completedCampaigns = $userSubscriptions->pluck('campaign')->filter(function ($campaign) {
    return $campaign->status === 'Won the Prize' || $campaign->status === 'Disabled by Admin';
})->unique();


    // $completedCampaigns = Campaign::orWhere('status', 'Won the Prize')
    // ->orWhere('status', 'Disabled by Admin')
    // ->get();
    return view('backend.campaigns.completed-campaigns', compact('completedCampaigns'));
}

    public function create()
    {
        return view('backend.campaigns.create');
    }
    public function createSubscription(Request $request)
    {
        // Validate and process the request data as needed
        $campaignId = $request->input('campaign_id');

        // Create a new subscription record
        $subscription = new Subscription();
        $subscription->user_id = auth()->user()->id; // Assuming you are using authentication
        $subscription->campaign_id = $campaignId; // Replace with the actual campaign ID
        $subscription->participation_id = 'com' . uniqid(); // Generate a unique subscription ID
        $subscription->save();
    
        // You can return the generated subscription ID if needed
        $campaigns = Campaign::all();
        return view('backend.campaigns.index', compact('campaigns'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target' => 'required|integer',
            'price' => 'required|string',
            'status' => 'required|in:Active,Won the Prize,Disabled by Admin',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7000',
        ]);
    
        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaign_images', 'public');
            $data['image'] = $imagePath;
        }
        Campaign::create($data);

        return redirect()->route('campaigns.index')->with('success', 'Campaign created successfully.');
    
    }

    public function show(Campaign $campaign)
    {
        // $campaign = Campaign::find($id);

        return view('frontend.show', compact('campaign'));
    }
    public function showSelectWinnerForm($campaignId)
    {
        // Return the Blade view for selecting a winner
        return view('backend.winner.select-winner', ['campaignId' => $campaignId]);
    }
    public function edit(Campaign $campaign)
    {
        return view('backend.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target' => 'required|integer',
            'price' => 'required|string',
            'status' => 'required|in:Active,Won the Prize,Disabled by Admin',

            // 'close_campaign_after' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:7000',
        ]);

        // $data = $request->all();
        $data = $request->all();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($campaign->image); // Delete previous image
            $imagePath = $request->file('image')->store('campaign_images', 'public');
            $data['image'] = $imagePath;
        }

        $campaign->update($data);

        return redirect()->route('campaigns.index')->with('success', 'Campaign updated successfully.');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index')->with('success', 'Campaign deleted successfully.');
    }
}