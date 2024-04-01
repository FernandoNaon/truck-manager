<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVehicle;
use App\Models\User;

class UserVehicleController extends Controller

{
   public function getUserVehicles(Request $request, $userId)
{
    $user = User::with('vehicles')->find($userId);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json(['user' => $user], 200);
}

    public function assignVehicleToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $userVehicle = UserVehicle::create([
            'user_id' => $request->user_id,
            'vehicle_id' => $request->vehicle_id,
        ]);

        return response()->json(['message' => 'Vehicle assigned to user successfully'], 200);
    }
}
