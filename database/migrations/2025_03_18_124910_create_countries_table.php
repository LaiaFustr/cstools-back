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
            $table->string('papainomi');
            $table->string('papaibusi');
            $table->string('papainomf');
            $table->string('papaibusf');
            $table->string('paarecod');
            $table->string('paarees');
            $table->string('papaidch');
            $table->string('pafmtdch');
            $table->string('pacpcx');
            $table->string('pacee');
            $table->string('padiv');
            $table->string('paestprv');
            $table->string('pabaja');

            $table->timestamps();
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
