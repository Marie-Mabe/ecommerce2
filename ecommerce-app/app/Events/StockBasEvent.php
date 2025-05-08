<?php

namespace App\Events;

use App\Models\Produit;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockBasEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $produit;

    /**
     * Create a new event instance.
     */
    public function __construct(Produit $produit)
    {
        $this->produit = $produit;
    }
} 