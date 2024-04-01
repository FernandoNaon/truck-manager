<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('id', 'DESC')->get();
        return response()->json([
            'vehicles' => $vehicles
        ], 200);
    }

    public function filterByPrice(Request $request)
    {
        $maxPrice = $request->input('max_price');
        
        if ($maxPrice !== null) {
            $maxPrice = (float) $maxPrice;
            $vehicles = Vehicle::where('price', '<=', $maxPrice)->orderBy('id', 'DESC')->get();
        } else {
            return response()->json(['error' => 'Please provide a maximum price.'], 400);
        }
        
        return response()->json([
            'vehicles' => $vehicles
        ], 200);
    }
    
    public function buyOrSell(Request $request, $vehicleId)
    {
        $request->validate([
            'has_owner' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $user_id = $request->input('user_id');
        $hasOwner = $user_id !== null;
        $vehicle = Vehicle::find($vehicleId);

        if ($vehicle) {
            $vehicle->has_owner = $hasOwner;
            $vehicle->user_id = $user_id;
            $vehicle->save();

            return response()->json(['message' => 'Vehicle updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
    }


}
