<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicioHasPuntuacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejerciciopuntuacions', function (Blueprint $table) {
            $table->id();
            $table->integer("puntuacion");
            $table->bigInteger("idUsuario")->unsigned();
            $table->foreign("idUsuario")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('ejercicio_has_puntuacions');
    }
}
