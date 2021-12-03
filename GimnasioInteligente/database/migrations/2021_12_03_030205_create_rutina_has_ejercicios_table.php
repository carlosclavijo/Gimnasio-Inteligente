<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinaHasEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutina_has_ejercicios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idRutina")->unsigned();
            $table->foreign("idRutina")->references("id")->on("rutinas")->onDelete("cascade");
            $table->bigInteger("idEjercicio")->unsigned();
            $table->foreign("idEjercicio")->references("id")->on("ejercicios")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutina_has_ejercicios');
    }
}
