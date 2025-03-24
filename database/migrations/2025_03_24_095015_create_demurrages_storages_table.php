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
        Schema::create('demurrage_storages', function (Blueprint $table) {

            $table->string('carrier');
            $table->enum('type', ['D', 'S']);
            $table->string('port');
            $table->integer('fromday');
            $table->integer('today');
            $table->float('tar20');
            $table->float('tar40');
            $table->date('valid');
            $table->float('tarsup');

            $table->unique(['carrier', 'type', 'port', 'fromday', 'today', 'valid']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demurrages_storages');
    }
    
};
