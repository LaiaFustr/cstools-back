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
        Schema::create('postalcodes', function (Blueprint $table) {
            $table->string('cpcouid'); //paisid
            $table->string('cptownm'); //nom ciudad
            $table->string('cptownmori'); //nom ciudad ori
            $table->string('cpstrpcori'); //cod. postal inicio original
            $table->string('cpendpcori'); //cod. postal final original
            $table->string('cpstrpc'); //cod. postal inicio busqueda
            $table->string('cpendpc'); //cod. postal final busqueda
            $table->string('cpprvid'); //id. provincia
            $table->string('cpprvcod'); //codigo provincia/estado
            $table->string('cpprvnom'); //nombre provincia/estado
            $table->string('cptownpcode'); //cod. ciudad principal
            $table->char('cptownplace'); //town placein
            $table->string('cpdeststat');
            $table->string('cptownid'); //cod. ciudad
            $table->char('cpaliasin');
            $table->string('cpmarcaesp');
            $table->char('cpbaja');

            $table->foreign('cpouid')->references('papaicod')->on('countries');

            $table->unique(['cpcouid','cptownm', 'cpstrpc']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postalcodes');
    }
};
