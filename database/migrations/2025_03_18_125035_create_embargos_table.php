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
        Schema::create('embargos', function (Blueprint $table) {
            $table->string('empaicod')->primary();
            $table->string('embobserv');
            $table->string('emexcl');
            $table->string('emusua');
            $table->string('emfeca');
            $table->string('emusum');
            $table->string('emfecm');
            $table->string('embaja');
            
            $table->timestamps();

            $table->foreign('empaicod')->references('papaicod')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embargos');
    }
};
