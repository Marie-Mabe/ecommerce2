<?php

namespace App\Listeners;

use App\Events\StockBasEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StockBasNotification;
use App\Models\User;

class StockBasListener
{
    /**
     * Handle the event.
     */
    public function handle(StockBasEvent $event): void
    {
        $produit = $event->produit;
        
        // Log l'alerte
        \Log::warning("Stock bas pour le produit {$produit->libelle} : {$produit->quantite} unités restantes (seuil: {$produit->seuil_alerte})");

        // Envoyer une notification aux administrateurs
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new StockBasNotification($produit));

        // Créer une alerte dans la base de données
        \DB::table('alertes_stock')->insert([
            'produit_id' => $produit->id,
            'message' => "Stock bas pour {$produit->libelle} : {$produit->quantite} unités restantes",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
} 