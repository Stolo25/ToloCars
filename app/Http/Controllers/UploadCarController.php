<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class UploadCarController extends Controller
{
    public function index()
    {
        $cars = Car::where('user_id', auth()->id())->latest()->get();
        return view('uploadcar', compact('cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:150',
            'year' => 'required|integer|min:1990|max:' . date('Y'),
            'transmission' => 'required|string',
            'capacity' => 'required|integer|min:2|max:8',
            'price_per_day' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);
        
        
        $validated['image'] = $request->file('image')->store('cars', 'public');
        $validated['user_id'] = auth()->id();
        
        Car::create($validated);
        return redirect()->route('uploadcar')->with('Uploaded', 'Your car is listed now!');
    }
    
    public function edit(Car $car)
    {
        
        $cars = Car::where('user_id', auth()->id())->latest()->get();

        return view('uploadcar', compact('cars', 'car'));
    }


    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:150',
            'year' => 'required|integer|min:1990|max:' . date('Y'),
            'transmission' => 'required|string',
            'capacity' => 'required|integer|min:2|max:8',
            'price_per_day' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);
        
        
        if ($request->hasFile('image')) {
             $validated['image'] = $request->file('image')->store('cars', 'public');}
             
             
             $car->update($validated);
             
            return redirect()->route('uploadcar')->with('Updated', 'The changes were applied to your car listing');
        
    
    }



    public function destroy(Car $car)
    {
        $car->delete();
        
        return redirect()->route('uploadcar')->with('Completed', 'Your car listing was removed from our server');
    }
}