<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{

 
    public function index()
    {
        // $subscriptions = Subscription::all();
        // return view('subscriptions.index', compact('subscriptions'));

        $features = Feature::all();
        return view('backend.features.index', compact('features'));
    }

    public function create()
    {
        // Load data needed for creating subscriptions (e.g., campaigns, users)
        // You may also load campaigns and users to populate dropdown/select options

        return view('backend.features.create');
    }
    public function store(Request $request ,Feature $feature )
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'direction' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('feature_images', 'public');
            $data['image'] = $imagePath;
        }

         $feature->create($data);
        return redirect()->route('features.index')->with('success', ' feature created successfully.');
    }
    public function edit(Feature $feature)
    {
        return view('backend.features.edit', compact('feature'));
    }
    public function update(Request $request,  Feature $feature)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'direction' => 'required|string|max:255',

            
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($feature->image); // Delete previous image
            $imagePath = $request->file('image')->store('feature_images', 'public');
            $data['image'] = $imagePath;
        }

        $feature->update($data);

        return redirect()->route('features.index',)->with('success', ' feature updated successfully.');
    }

    public function destroy( Feature $feature)
    {
        $feature->delete();

        return redirect()->route('campaigns.show')->with('success', ' feature deleted successfully.');
    }
}