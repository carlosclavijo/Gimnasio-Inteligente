<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinaHasPuntuacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutina_has_puntuacions', function (Blueprint $table) {
            $table->id();
            $table->integer("puntuacion");
            $table->bigInteger("idUsuario")->unsigned();
            $table->foreign("idUsuario")->references("id")->on("users")->onDelete("cascade");
            $table->bigInteger("idRutina")->unsigned();
            $table->foreign("idRutina")->references("id")->on("rutinas")->onDelete("cascade");
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
        Schema::dropIfExists('rutina_has_puntuacions');
    }
}
