<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainer;

class TrainerController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:trainers',
            'password' => 'required|min:8',
            'full_name' => 'required',
        ]);

        $trainer = Trainer::create($data);

        return response()->json(['message' => 'Trainer registered successfully', 'trainer' => $trainer]);
    }

    public function  update(Request $request, Trainer $trainer)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:trainers,email,' . $trainer->id,
            'password' => 'sometimes|min:8', // Optional, only if password is included in request
            'full_name' => 'required',
        ]);

        $trainer->update($data);

        return response()->json(['message' => 'Trainer updated successfully', 'trainer' => $trainer]);
    }

    public function show(Request $request, Trainer $trainer)
    {
        return response()->json(['trainer' => $trainer]);
    }

    public function destroy(Request $request, Trainer $trainer)
    {
        $trainer->delete();

        return response()->json(['message' => 'Trainer deleted successfully']);
    }
}
