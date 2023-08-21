<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hero;

class HeroController extends Controller
{
     public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'ability' => 'required|in:attacker,defender',
            'trainer_id' => 'required|exists:trainers,id',
            'started_training' => 'required|date',
            'suit_colors' => 'required',
            'starting_power' => 'required|numeric|min:0',
            'current_power' => 'required|numeric|min:0',
        ]);

        $hero = Hero::create($data);

        return response()->json(['message' => 'Hero created successfully', 'hero' => $hero]);
    }

     public function update(Request $request, Hero $hero)
    {
        $data = $request->validate([
            'name' => 'required',
            'ability' => 'required|in:attacker,defender',
            'started_training' => 'required|date',
            'suit_colors' => 'required',
            'starting_power' => 'required|numeric|min:0',
            'current_power' => 'required|numeric|min:0',
        ]);

        $hero->update($data);

        return response()->json(['message' => 'Hero updated successfully', 'hero' => $hero]);
    }

    public function assignToTrainer(Request $request, Hero $hero)
    {
        $data = $request->validate([
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $hero->update($data);

        return response()->json(['message' => 'Hero assigned to trainer successfully']);
    }

    public function show(Request $request, Hero $hero)
    {
        return response()->json(['hero' => $hero]);
    }

    //Method show heroes that belong to the specified trainer
    public function getAllByTrainer(Request $request, Trainer $trainer)
    {
        $heroes = Hero::where('trainer_id', $trainer->id)->get();

        return response()->json(['heroes' => $heroes]);
    }

    public function unassignFromTrainer(Request $request, Hero $hero)
    {
        $hero->trainer_id = null;
        $hero->save();

        return response()->json(['message' => 'Hero unassigned successfully']);
    }

    public function destroy(Request $request, Hero $hero)
    {
        $hero->delete();

        return response()->json(['message' => 'Hero deleted successfully']);
    }
}
