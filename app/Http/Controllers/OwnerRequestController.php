<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class OwnerRequestController extends Controller
{
    public function index()
    {
        $reservations = Reservation::whereHas('car', function ($query) 
        {$query->where('user_id', auth()->id());})->with(['user', 'car'])->latest()->get();
        return view('requests', compact('reservations'));
    }

    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'approved']);
        return redirect()->back()->with('Approved', 'You approved this reservation!!');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'rejected']);
        return redirect()->back()->with('Rejected', 'You have rejected this offer, no more money!!!');
    }
}