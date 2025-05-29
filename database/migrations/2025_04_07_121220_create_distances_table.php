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
        Schema::create('distances', function (Blueprint $table) { //FCDISTTE
            $table->string('oripai'); //pais origen, p.ej. ES ---DTORIPAI
            $table->string('oricp'); //cod postal pais origen ---DTORIGEN
            $table->string('cptownori');
            $table->string('despai'); //pais destino, p.ej. ES  ---DTDESPAI
            $table->string('descp'); //cod postal pais destino ---DTDESTIN
            $table->string('cptowndest');
            $table->string('tramocp'); //pais origen, p.ej. ES ---DTTRAMO
            $table->string('dtpuerto'); //O origen D destino ---DTPUERTO
            $table->string('orinom'); //pais origen nom 
            $table->string('desnom'); //cpais dest nom 
            $table->float('distkmokay'); //distancia en km acordada ---DTDISTKMOK
            $table->float('distm'); //dist m ---DTDISTMET 
            $table->float('distkm'); //dist km ---DTDISTKM
            $table->float('disttimesec'); //tiempo en segundos ---DTTIEMSEG
            $table->string('font'); //fuente de origen info ---DTFUENTE
            $table->string('state'); //estado (OK siempre) ---DTESTADO
            $table->string('datecalc'); //fecha de calculo ---DTFECALT
            $table->string('discharge'); //baja '' o !='' habitualmente S  (booleano) ---DTBAJA


            //no se com oañadir correctamente las clavces ajenas. no hay ninguna que referencie a cptownm en postalcodes
            /* 
            $table->foreign('oripai')->references('cpcouid')->on('postalcodes')->onDelete('cascade');
            $table->foreign('despai')->references('cpcouid')->on('postalcodes')->onDelete('cascade');
            $table->foreign('oricp')->references('cpstrpc')->on('postalcodes')->onDelete('cascade');
            $table->foreign('descp')->references('cpstrpc')->on('postalcodes')->onDelete('cascade'); */

            $table->foreign(['oripai', 'cptownori', 'oricp'])->references(['cpcouid','cptownm', 'cpstrpc'])->on('postalcodes')->onDelete('cascade');
            $table->foreign(['despai', 'cptowndest', 'descp'])->references(['cpcouid','cptownm', 'cpstrpc'])->on('postalcodes')->onDelete('cascade');
            $table->unique(['oripai', 'oricp', 'despai', 'descp']);

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
