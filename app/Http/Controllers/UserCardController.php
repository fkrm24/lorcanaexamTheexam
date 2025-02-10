<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class UserCardController extends Controller
{
    // Récupérer les cartes possédées par l'utilisateur connecté
    public function getUserCards()
    {
        $user = Auth::user();
        return response()->json([
            'owned_cards' => $user->cards // Relation à ajouter dans le modèle User
        ]);
    }

    // Mettre à jour les cartes possédées par l'utilisateur
    public function updateOwnedCards(Request $request, $id)
    {
        $user = Auth::user();
        $card = Card::findOrFail($id);

        if ($request->input('owned')) {
            $user->cards()->attach($card->id);
        } else {
            $user->cards()->detach($card->id);
        }

        return response()->json([
            'message' => 'Cartes mises à jour avec succès !'
        ]);
    }
}

