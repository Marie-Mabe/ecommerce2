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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('marque');
            $table->decimal('prixunit', 10, 2);
            $table->integer('quantite');
            $table->date('date_peremption');
            $table->string('image');
            $table->boolean('statut')->default(true);
            $table->foreignId('id_categorie')->constrained('categories');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
