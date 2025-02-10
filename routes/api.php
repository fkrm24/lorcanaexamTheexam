<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\SetController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\UserCardController;
use App\Http\Controllers\WishlistController;

Route::get("/sets", [SetController::class, "index"]);
Route::get("/sets/{id}", [SetController::class, "single"]);
Route::get("/sets/{id}/cards", [SetController::class, "cards"]);

Route::get("/cards", [CardController::class, "index"]);
Route::get("/cards/{id}", [CardController::class, "single"]);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    // Gestion des cartes possédées
    Route::get('/me/cards', [UserCardController::class, 'getUserCards']);
    Route::post('/me/{id}/update-owned', [UserCardController::class, 'updateOwnedCards']);

    // Gestion de la wishlist
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist']);
    Route::get('/wishlist', [WishlistController::class, 'getWishlist']);
});