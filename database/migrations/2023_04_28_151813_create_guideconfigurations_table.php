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
        Schema::create('guideconfigurations', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('libelle');
            $table->text('description');
            $table->string('image');
            $table->text('video_url');
            $table->text('businesses');
            $table->string('status',1)->comment('1=> Active, 0=> Desactiver')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guideconfigurations');
    }
};
