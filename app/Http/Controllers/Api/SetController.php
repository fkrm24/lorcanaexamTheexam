<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SetResource;
use App\Models\Card;
use App\Models\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{
    public function index()
    {
        //récupération des sets
        $sets = Set::all();
        //envoi en json
        return SetResource::collection($sets);
    }

    public function single($id)
    {
        //récupération du set
        $set = Set::findOrFail($id);
        //envoi en json
        return new SetResource($set);
    }

    public function cards($id)
    {
        $set = Set::findOrFail($id);

        return response()->json(
            [
                "data" => $set->cards
            ]
        );
    }

    public function store(Request $request)
{
    $request->validate([
        'api_id' => 'required|unique:sets',
        'name' => 'required|string',
        'code' => 'required|unique:sets',
        'release_date' => 'nullable|date',
        'prerelease_date' => 'required|date',
    ]);

    $set = Set::create($request->all());

    return new SetResource($set);
}

public function update(Request $request, $id)
{
    $set = Set::findOrFail($id);

    $request->validate([
        'name' => 'sometimes|string',
        'release_date' => 'nullable|date',
        'prerelease_date' => 'sometimes|date',
    ]);

    $set->update($request->all());

    return new SetResource($set);
}

public function destroy($id)
{
    $set = Set::findOrFail($id);
    $set->delete();

    return response()->json(["message" => "Set deleted successfully"]);
}

}
