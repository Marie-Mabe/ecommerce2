<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_paniers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_panier')->constrained('paniers')->cascadeOnDelete();
            $table->foreignId('id_produit')->constrained('produits')->cascadeOnDelete();
            $table->integer('quantite')->default(1);
            $table->decimal('prix_unitaire', 8, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articlepaniers');
    }
};
