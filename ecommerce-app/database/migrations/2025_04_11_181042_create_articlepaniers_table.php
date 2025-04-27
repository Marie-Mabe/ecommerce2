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
        Schema::create('articlepaniers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produit')->constrained('produits')->onDelete('cascade');
            $table->foreignId('id_panier')->constrained('paniers')->onDelete('cascade');
            $table->integer('quantite');
            $table->double('prixTotal', 8, 2);
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
