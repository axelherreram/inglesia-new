<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunionTable extends Migration
{
    public function up()
    {
        Schema::create('comunion', function (Blueprint $table) {
            $table->increments('comunion_id')->unsigned();
            $table->string('NoPartida', 20);
            $table->string('folio', 50);
            $table->dateTime('fecha_comunion');
            $table->integer('persona_participe_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('municipio_id')->unsigned();
            $table->integer('sacerdote_id')->unsigned()->comment('Referencia al sacerdote en la tabla personas');
            $table->integer('padre_id')->unsigned()->nullable();
            $table->integer('madre_id')->unsigned()->nullable();
            $table->timestamps(0);

            // Definición de claves foráneas
            $table->foreign('persona_participe_id')->references('persona_id')->on('personas');
            $table->foreign('municipio_id')->references('municipio_id')->on('municipio');
            $table->foreign('departamento_id')->references('departamento_id')->on('departamento');
            $table->foreign('sacerdote_id')->references('persona_id')->on('personas');
            $table->foreign('padre_id')->references('persona_id')->on('personas');
            $table->foreign('madre_id')->references('persona_id')->on('personas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comunion');
    }
}