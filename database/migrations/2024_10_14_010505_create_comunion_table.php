<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunionTable extends Migration
{
    public function up()
    {
        Schema::create('comunion', function (Blueprint $table) {
            $table->increments('comunion_id');
            $table->string('NoPartida', 20);
            $table->string('folio', 50);
            $table->dateTime('fecha_comunion');
            $table->string('nombre_persona_participe', 255);
            $table->string('nombre_padre', 255)->nullable();
            $table->string('nombre_madre', 255)->nullable();
            $table->dateTime('fecha_nacimiento');
            $table->integer('dato_parroquia_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('municipio_id')->unsigned();
            $table->timestamps();

            $table->foreign('dato_parroquia_id')->references('dato_parroquia_id')->on('dato_general_parroquia');
            $table->foreign('municipio_id')->references('municipio_id')->on('municipio');
            $table->foreign('departamento_id')->references('departamento_id')->on('departamento');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comunion');
    }
}
