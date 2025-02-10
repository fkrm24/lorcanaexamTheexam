<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Ajouter une carte à la wishlist
    public function addToWishlist(Request $request)
    {
        $user = Auth::user();
        $card = Card::findOrFail($request->input('card_id'));

        $user->wishlist()->attach($card->id);

        return response()->json([
            'message' => 'Carte ajoutée à la wishlist !'
        ]);
    }

    // Retirer une carte de la wishlist
    public function removeFromWishlist(Request $request)
    {
        $user = Auth::user();
        $card = Card::findOrFail($request->input('card_id'));

        $user->wishlist()->detach($card->id);

        return response()->json([
            'message' => 'Carte retirée de la wishlist !'
        ]);
    }

    // Lister les cartes de la wishlist
    public function getWishlist()
    {
        $user = Auth::user();
        return response()->json([
            'wishlist' => $user->wishlist
        ]);
    }
}
