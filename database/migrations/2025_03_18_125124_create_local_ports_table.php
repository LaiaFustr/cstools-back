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
        Schema::create('local_ports', function (Blueprint $table) {
            $table->string('plptoloc')->primary();
            $table->string('plcodpos');
            $table->string('plnompto');
            $table->string('pldlgni');//Ofic. IMP Dach: 231, 232, ..
            $table->string('pldlgne'); //Ofic. EXP Dach: 231, 232, ..
            $table->string('plfecalt');
            $table->string('plbaja');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_ports');
    }
};
