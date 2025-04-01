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
        Schema::create('distances', function (Blueprint $table) { //ddistte
            $table->string('oripai'); //pais origen, p.ej. ES
            $table->string('oricp');//cod postal pais origen
            $table->string('despai'); //pais destino, p.ej. ES
            $table->string('descp');//cod postal pais destino
            $table->string('tramocp'); //pais origen, p.ej. ES
            $table->string('dtpuerto');//O origen D destino
            $table->string('orinom'); //pais origen nom
            $table->string('desnom');//cpais dest nom
            $table->float('distkmokay'); //distancia en km acordada
            $table->float('distm');//dist m
            $table->float('distkm');//dist km
            $table->float('disttimesec');//tiempo en segundos
            $table->string('font');//fuente de origen info
            $table->string('state');//estado (OK siempre)
            $table->string('datecalc');//fecha de calculo
            $table->string('discharge');//baja '' o !='' habitualmente S (booleano)

            $table->unique(['oripai','oricp','despai','descp']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distances');
    }
};
