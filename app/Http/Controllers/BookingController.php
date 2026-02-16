<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $anaks = collect();
        $user = Auth::user();

        if ($user) {
            $anaks = $user->anaks()->latest()->get();
        }

        return view('booking.index', compact('anaks', 'user'));
    }
}
