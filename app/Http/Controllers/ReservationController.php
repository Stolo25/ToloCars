<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Car;

class ReservationController extends Controller
{
    public function mybookings()
    {
        $reservations=Reservation::with('car')->where('user_id', auth()->id())->latest()->get();
        //$reservations= auth()->user()->reservations->latest();
        return view('mybookings', compact('reservations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id'=>'required|exists:cars,id',
            'start_date'=>'required|date|after_or_equal:today',
            'end_date'=> 'required|date|after:start_date',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $car = Car::findOrFail($validated['car_id']);

        $hasOverlap = $car->reservations()
            ->where(function ($query) use ($validated) {
                $query->where('start_date', '<=', $validated['end_date'])
                ->where('end_date', '>=', $validated['start_date']);})->exists();

        if ($hasOverlap) {
            return back()->with('Unavaliable', 'This can is not available for these dates');}

        $start = new \DateTime($validated['start_date']);
        $end   = new \DateTime($validated['end_date']);
        $days  = $start->diff($end)->days + 1;
        
        $validated['total_price'] = $days * $car->price_per_day;

        Reservation::create($validated);
        
        return redirect()->route('mybookings')->with('Congratulations', 'You got a car to drive for few days!');
    }
    
    
    
    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($reservation->end_date < now()) {return back()->with('error', 'This booking is expired already');}
        
        $reservation->update(['status' => 'cancelled']);
        
        return redirect()->route('mybookings')->with('Completed', 'You cancelled this reservation');
    }
}