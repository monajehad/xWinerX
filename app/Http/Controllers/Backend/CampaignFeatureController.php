<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignFeature;
use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;

class CampaignFeatureController extends Controller
{

    public function createFeatures(Campaign $campaign)
    {
        // $campaign = Campaign::find($id);

        return view('backend.campaigns.features', compact('campaign'));
    }
    public function store(Request $request, Campaign $campaign)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaign_feature_images', 'public');
            $data['image'] = $imagePath;
        }

         $campaign->features()->create($data);
        return redirect()->route('campaigns.index', $campaign)->with('success', 'Campaign feature created successfully.');
    }

    public function update(Request $request, Campaign $campaign, CampaignFeature $feature)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($feature->image); // Delete previous image
            $imagePath = $request->file('image')->store('campaign_feature_images', 'public');
            $data['image'] = $imagePath;
        }

        $feature->update($data);

        return redirect()->route('campaigns.show', $campaign)->with('success', 'Campaign feature updated successfully.');
    }

    public function destroy(Campaign $campaign, CampaignFeature $feature)
    {
        $feature->delete();

        return redirect()->route('campaigns.show', $campaign)->with('success', 'Campaign feature deleted successfully.');
    }
}