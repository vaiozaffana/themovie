<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class moviePurchaseController extends Controller
{
    public function showCheckout($id)
    {
        $movie = Movie::findOrFail($id);

        return view('payment.checkout', [
            'movie' => $movie // Mengirim single movie, bukan collection
        ]);
    }

    /**
     * Proses pembayaran
     */
    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'card_number' => 'required_if:payment_method,credit_card',
            'card_name' => 'required_if:payment_method,credit_card',
            'expiry' => 'required_if:payment_method,credit_card',
            'cvv' => 'required_if:payment_method,credit_card',
            'terms' => 'accepted'
        ]);

        // Simpan data pembayaran atau proses pembayaran
        // Redirect ke halaman sukses dengan data transaksi

        return redirect()->route('payment.success', $id)
            ->with('success', 'Payment successful!');
    }

    /**
     * Halaman sukses pembayaran
     */
    public function paymentSuccess($id)
    {
        $movie = Movie::findOrFail($id);
        return view('payment.success', compact('movie'));
    }

    public function buyMovie($id)
    {
        $user = auth()->user();
        $movie = Movie::findOrFail($id);

        if ($user->movies()->where('movie_id', $id)->exists()) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'You have already purchased this movie.'
            ], 400);
        }

        $user->movies()->attach($movie->id);

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'Movie purchased successfully!'
        ], 201);
    }

    public function reviewMovie(Request $request, $id)
    {
        $user = auth()->user();
        $movie = Movie::findOrFail($id);

        if (!$user->movies()->where('movie_id', $id)->exists()) {
            return response()->json([
                'status' => 'error',
                'code' => 403,
                'message' => 'You can only review movies you have purchased.'
            ], 403);
        }

        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);

        $user->movies()->updateExistingPivot($id, [
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Review submitted successfully',
            'data' => [
                'movie_id' => $id,
                'user_id' => $user->id,
                'rating' => $request->rating,
                'review' => $request->review
            ]
        ], 200);
    }


    public function deleteMovie($id)
    {
        $user = auth()->user();
        $movie = Movie::findOrFail($id);
        if (!$movie) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Movie not found.'
            ], 404);
        }

        if (!$user->movies()->where('movie_id', $id)->exists()) {
            return response()->json([
                'status' => 'error',
                'code' => 403,
                'message' => 'You cannot delete a movie you haven\'t purchased.'
            ], 403);
        }

        $user->movies()->detach($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Movie removed from your collection.'
        ], 200);
    }
}
