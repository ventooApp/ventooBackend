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
            $table->integer('price');
            $table->integer('qte');
            $table->text('description');
            $table->text('image');
            $table->string('status',1)->comment('1=> Active, 0=> Desactiver')->default('1');
            $table->string('status_admin',1)->comment('1=> Active, 0=> Desactiver')->default('1');
            $table->integer('created_by');
            $table->foreignId('categorieproduit_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('boutique_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
