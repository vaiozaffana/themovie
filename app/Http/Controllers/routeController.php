<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class routeController extends Controller
{
    public function showMyMovies() {
        return view("user.my-movies");
    }
}
