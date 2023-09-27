<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    public function create()
    {
        return view('backend.payment.add');
    }
    public function store(Request $request)
{
    // Validation rules for card input fields
    $validatedData = $request->validate([
        'card_type' => 'required|string', // Add any validation rules you need
        'card_number' => 'required|string', // Add any validation rules you need
        // 'card_last_four' => 'required|string', // Add any validation rules you need
    ]);

    // Get the authenticated user
    $user = auth()->user();
    $lastFourDigits = substr($validatedData['card_number'], -4);

    // Create a new card instance and associate it with the user
    $card = new PaymentMethod();
    $card->user_id=$user->id;
    $card->card_type = $validatedData['card_type'];
    $card->card_number = $validatedData['card_number'];
    $card->card_last_four = $lastFourDigits;

    // Save the card to the user's cards relationship
    $card->save();

    // Redirect to a success page or any other desired action
    return redirect()->route('billing-detail')->with('success', 'Card added successfully.');
}


    public function edit($id)
{
    $card = PaymentMethod::findOrFail($id);
    return view('backend.payment.edit', ['card' => $card]);
}
// Update Card (PUT)
public function update(Request $request, $id)
{
    // Validate and update the card information

    $card = PaymentMethod::findOrFail($id);
    $card->update([
        'card_type' => $request->input('card_type'),
         'card_number'=>$request->input('card_number'),

         'card_last_four' => substr($request->input('card_number'), -4),

        // Update other card fields as needed
    ]);

    return redirect()->route('billing-detail')->with('success', 'Card updated successfully');
}
// Delete Card (DELETE)
public function destroy($id)
{
    $card = PaymentMethod::findOrFail($id);
    $card->delete();
    return redirect()->route('billing-detail')->with('success', 'Card deleted successfully');
}
}
