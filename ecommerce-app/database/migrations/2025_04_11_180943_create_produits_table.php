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
            $table->string('libelle')->unique();
            $table->string('marque');
            $table->double('prixunit', 8, 2);
            $table->integer('quantite');
            $table->date('date_peremption');
            $table->string('image');
            $table->enum('statut', ['dispo', 'indispo'])->default('dispo');
            $table->foreignId('id_categorie')->constrained('categories')->onDelete('cascade');
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
