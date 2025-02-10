<?
namespace Database\Factories;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserCardFactory extends Factory
{
    /**
     * Indiquer que le modèle appartient à la table user_cards
     */
    protected $model = User::class;

    /**
     * Définir l'état par défaut pour la table pivot
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Prendre une carte aléatoire déjà existante
        $cardId = Card::inRandomOrder()->first()->id;

        // Prendre un utilisateur aléatoire
        $userId = User::inRandomOrder()->first()->id;

        return [
            'user_id' => $userId,
            'card_id' => $cardId, // Attacher une carte aléatoire
        ];
    }
}
