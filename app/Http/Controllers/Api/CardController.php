<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Set;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        //récupération des cartes
        $cards = Card::all();

        //renvoi en json
        return response()->json(
            [
                "data" => $cards
            ]
        );
    }

    public function single($id)
    {
        $card = Card::findOrFail($id);

        return response()->json([
            "card" => $card
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'api_id' => 'required|unique:cards',
        'set_id' => 'required|exists:sets,id',
        'name' => 'required|string',
        'number' => 'required|integer',
        'version' => 'required|string',
        'cardIdentifier' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|url',
        'thumbnail' => 'required|url',
        'rarity' => 'required|string',
        'story' => 'required|string',
    ]);

    $card = Card::create($request->all());

    return response()->json(["card" => $card]);
}

public function update(Request $request, $id)
{
    $card = Card::findOrFail($id);

    $request->validate([
        'name' => 'sometimes|string',
        'number' => 'sometimes|integer',
        'version' => 'sometimes|string',
        'image' => 'sometimes|url',
        'thumbnail' => 'sometimes|url',
    ]);

    $card->update($request->all());

    return response()->json(["card" => $card]);
}

public function destroy($id)
{
    $card = Card::findOrFail($id);
    $card->delete();

    return response()->json(["message" => "Card deleted successfully"]);
}

}
