<?php

namespace App\Http\Controllers\web\actions;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show($id)
{
    $movie = Movie::find($id);

    if (!$movie->hasAlreadyPurchased()) {
        notify()->warning('You must purchase this movie first');
        return back();
    }

    return view('', compact('movie'));
}

}
