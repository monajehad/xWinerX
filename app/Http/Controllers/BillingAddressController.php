<?php

namespace App\Http\Controllers;

use App\Models\BillingAddress;
use Illuminate\Http\Request;
class BillingAddressController extends Controller
{
    public function create()
    {
        // Show a form to create a new billing address
        return view('backend.billing-addresses.create');
    }

    public function store(Request $request)
    {
        // Validation rules for the form fields
        $validatedData = $request->validate([
            'user_id' => 'required|integer', // Assuming user_id is a hidden field
            'city' => 'required|string|max:255',
            'street	' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
        ]);
    
        // Create a new billing address instance and fill it with the validated data
        $billingAddress = new BillingAddress();
        $billingAddress->user_id = $validatedData['user_id'];
        $billingAddress->city = $validatedData['city'];
        $billingAddress->street	 = $validatedData['street	'];
        $billingAddress->postal_code = $validatedData['postal_code'];
        $billingAddress->country = $validatedData['country'];
        $billingAddress->mobile = $validatedData['mobile'];
    
        // Save the billing address to the database
        $billingAddress->save();
    
        // Redirect to a success page or back to the form with a success message
        return redirect()->route('billing-detail')->with('success', 'Billing address added successfully.');
    }
    

    public function edit(BillingAddress $billingAddress)
    {
        // Show a form to edit an existing billing address
        return view('backend.billing-addresses.edit', compact('billingAddress'));
    }

    public function update(Request $request, BillingAddress $billingAddress)
{
    // Validation rules for the form fields
    $validatedData = $request->validate([
        'user_id' => 'required|integer',
        'city' => 'required|string|max:255',
        'street	' => 'string|max:255',
        'postal_code' => 'required|string|max:10',
        'country' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        // Add any other validation rules as needed
    ]);

    // Update the billing address with the validated data
    $billingAddress->update($validatedData);

    // Redirect to a success page or back to the form with a success message
    return redirect()->route('billing-detail')->with('success', 'Billing address updated successfully.');
}


public function destroy(BillingAddress $billingAddress)
{
    // Delete the billing address
    $billingAddress->delete();

    // Redirect to a success page or back to the list of addresses
    return redirect()->route('billing-detail')
        ->with('success', 'Billing address deleted successfully');
}
}
