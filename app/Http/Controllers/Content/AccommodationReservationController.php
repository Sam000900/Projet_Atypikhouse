<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccommodationReservation;

class AccommodationReservationController extends Controller
{
    // CREATE
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date',
            'accommodation_id' => 'required|integer',
            'price_paid' => 'required|decimal:0,2'
        ]);

        AccommodationReservation::create([
            'arrival_date' => $request->arrival_date,
            'departure_date' => $request->departure_date,
            'accommodation_id' => $request->accommodation_id,
            'price_paid' => $request->price_paid,
            'user_id' => Auth::id(),
        ]);

        return to_route('hebergement');
    }

    // READ
    public function getReservationsForAccommodation($accommodationId)
    {
        return AccommodationReservation::where('accommodation_id', $accommodationId)->get();
    }

    public function getReservationsForUser()
    {
        $user = Auth::user();
        return AccommodationReservation::with('accommodation')->where('user_id', $user->id)->get();
    }
}
