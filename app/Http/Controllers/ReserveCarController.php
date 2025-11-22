<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReserveCarController extends Controller

{
    function index()
    {
        $reservecars = \App\Models\Car::all();
        return view('reservecars.index', compact('reservecars'));
    }
    
    function show($reservecar)
    {
        $reservecar = \App\Models\Car::find($reservecar);
        $reviews = \App\Models\Review::where('car_id', $reservecar->id)->get();

        return view('reservecars.show', compact('reservecar', 'reviews'));
    }
}
