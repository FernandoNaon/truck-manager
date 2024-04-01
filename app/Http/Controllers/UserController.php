<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return response()->json([
            'users' => $users
        ], 200);
    }
    public function updateCash(Request $request, $userId)
    {
        $request->validate([
            'cash' => 'required|numeric',
        ]);
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $cash = $request->input('cash');
        $user-> $cash;
        $user->save();
        return response()->json(['message' => 'Vehicle bought successfully'], 200);
    }



}
