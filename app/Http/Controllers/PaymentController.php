<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showCheckout($id)
    {
        $movie = Movie::findOrFail($id);

        return view('user.payment', [
            'movie' => $movie
        ]);
    }

    public function processPayment(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $user = auth()->user();


        if ($user->hasAlreadyPurchased($movie->id)) {
            return redirect()->back()
                ->with('error', 'You have already purchased this movie');
        }

        $request->validate([
            'payment_method' => 'required|string',
            'card_number' => 'required_if:payment_method,credit_card',
            'card_name' => 'required_if:payment_method,credit_card',
            'expiry' => 'required_if:payment_method,credit_card',
            'cvv' => 'required_if:payment_method,credit_card',
            'terms' => 'accepted'
        ]);

        try {
            auth()->user()->purchasedMovies()->attach($movie->id, [
                'price' => $movie->price,
                'purchased_at' => now()
            ]);

            return redirect()->route('payment.success', ['id' => $movie->id])
                ->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function paymentSuccess($id)
    {
        $movie = Movie::findOrFail($id);
        return view('user.payment_success', [
            'movie' => $movie,
            'redirect_url' => route('my-movies')
        ]);
    }
}
