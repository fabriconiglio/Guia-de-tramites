<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id')->nullable(); // Para la relación padre-hijo
            $table->string('name');
            $table->string('address');
            $table->decimal('lat', 10, 7)->nullable(); // Latitud para el mapa
            $table->decimal('lng', 10, 7)->nullable(); // Longitud para el mapa
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('opening_hours')->nullable();
            $table->timestamps();

            // Clave foránea para la auto-relación
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
