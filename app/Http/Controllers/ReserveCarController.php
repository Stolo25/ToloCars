<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReserveCarController extends Controller

{
    function index()
    {
        return view(view:'reservecars.index');
    }
    
    function show($reservecar)
    {
        return view('reservecars.show', compact(var_name: 'reservecar'));
    }
}
