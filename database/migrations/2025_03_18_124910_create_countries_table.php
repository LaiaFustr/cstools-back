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
        Schema::create('countries', function (Blueprint $table) {
            $table->string('papaicod')->primary();
            $table->string('papainom');
            $table->string('papaibus');
            $table->string('papainomp');
            $table->string('papaibusp');
            $table->string('papainome');
            $table->string('papaibuse');
            $table->string('papainomf');
            $table->string('papaibusf');
            $table->string('paarecod');
            $table->string('paarees');
            $table->string('papaidch');
            $table->string('pafmtdch');
            $table->string('pacpcx');
            $table->string('pacee');
            $table->string('padiv')->nullable();
            $table->string('paestprv')->nullable();
            $table->string('pabaja')->nullable();

            $table->timestamps();

            $table->unique(['papainom', 'papaicod']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
