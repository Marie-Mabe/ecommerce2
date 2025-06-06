<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Events\StockBasEvent;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $fillable = [
        'libelle',
        'marque',
        'prixunit',
        'quantite',
        'date_peremption',
        'image',
        'statut',
        'id_categorie',
        'fournisseur_id',
        'seuil_alerte'
    ];

    protected $dates = [
        'date_peremption',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'date_peremption' => 'date',
        'statut' => 'boolean',
        'seuil_alerte' => 'integer'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

        public function paniers()
{
    return $this->belongsToMany(Panier::class, 'panier_produit')
                ->withPivot('quantite', 'prix')
                ->withTimestamps();
}
    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class);
    }

    /**
     * Ajuster le stock du produit
     * @param int $quantite Quantité à ajouter (positive) ou retirer (négative)
     * @param string $motif Motif du mouvement
     * @param string|null $reference Référence optionnelle du mouvement
     * @return bool
     */
    public function ajusterStock(int $quantite, string $motif, ?string $reference = null): bool
    {
        try {
            DB::beginTransaction();

            // Déterminer le type de mouvement
            $type = $quantite >= 0 ? 'entree' : 'sortie';
            $quantiteAbs = abs($quantite);

            // Vérifier si on peut retirer la quantité demandée
            if ($type === 'sortie' && $this->quantite < $quantiteAbs) {
                throw new \Exception("Stock insuffisant");
            }

            // Créer le mouvement de stock
            $this->mouvements()->create([
                'quantite' => $quantiteAbs,
                'type' => $type,
                'motif' => $motif,
                'reference' => $reference
            ]);

            // Mettre à jour le stock
            $this->quantite += $quantite;
            $this->save();

            // Vérifier le seuil d'alerte
            if ($this->quantite <= $this->seuil_alerte) {
                // TODO: Implémenter la notification de stock bas
                event(new StockBasEvent($this));
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Ajouter du stock
     * @param int $quantite Quantité à ajouter
     * @param string $motif Motif de l'entrée
     * @param string|null $reference Référence optionnelle
     * @return bool
     */
    public function ajouterStock(int $quantite, string $motif, ?string $reference = null): bool
    {
        return $this->ajusterStock(abs($quantite), $motif, $reference);
    }

    /**
     * Retirer du stock
     * @param int $quantite Quantité à retirer
     * @param string $motif Motif de la sortie
     * @param string|null $reference Référence optionnelle
     * @return bool
     */
    public function retirerStock(int $quantite, string $motif, ?string $reference = null): bool
    {
        return $this->ajusterStock(-abs($quantite), $motif, $reference);
    }

    /**
     * Définir le seuil d'alerte pour le stock bas
     * @param int $seuil Nouveau seuil d'alerte
     * @return bool
     * @throws \Exception si le seuil est négatif
     */
    public function definirSeuilAlerte(int $seuil): bool
    {
        if ($seuil < 0) {
            throw new \Exception("Le seuil d'alerte ne peut pas être négatif");
        }

        $this->seuil_alerte = $seuil;
        $resultat = $this->save();

        // Vérifier immédiatement si le stock actuel est inférieur au nouveau seuil
        if ($resultat && $this->quantite <= $this->seuil_alerte) {
            event(new StockBasEvent($this));
        }

        return $resultat;
    }

    /**
     * Vérifier si le stock est bas (en dessous ou égal au seuil d'alerte)
     * @return bool
     */
    public function estStockBas(): bool
    {
        return $this->quantite <= $this->seuil_alerte;
    }

    /**
     * Obtenir la marge avant le seuil d'alerte
     * @return int
     */
    public function margeAvantSeuil(): int
    {
        return $this->quantite - $this->seuil_alerte;
    }

        public function stock()
    {
        return $this->hasOne(Stock::class, 'id_produit');
    }
    

        public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produits')
                    ->withPivot('quantite', 'prix')
                    ->withTimestamps();
    }

    public function getPrixUnitaireAttribute()
{
    return $this->attributes['prixunit'];
}
}