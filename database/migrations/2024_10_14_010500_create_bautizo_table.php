<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBautizoTable extends Migration
{
    public function up()
    {
        Schema::create('bautizo', function (Blueprint $table) {
            $table->increments('bautizo_id');
            $table->integer('dato_parroquia_id')->unsigned();
            $table->string('NoPartida', 20);
            $table->string('folio', 50);
            $table->dateTime('fecha_bautizo');
            $table->string('nombre_persona_bautizada', 255);
            $table->string('edad', 4);
            $table->dateTime('fecha_nacimiento');
            $table->string('aldea', 255)->nullable();
            $table->integer('municipio_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->string('nombre_padre', 255)->nullable();
            $table->string('nombre_madre', 255)->nullable();
            $table->string('nombre_sacerdote', 255);
            $table->string('nombre_padrino', 255)->nullable();
            $table->string('nombre_madrina', 255)->nullable();
            $table->string('margen', 200)->nullable();
            $table->timestamps();

            $table->foreign('dato_parroquia_id')->references('dato_parroquia_id')->on('dato_general_parroquia');
            $table->foreign('municipio_id')->references('municipio_id')->on('municipio');
            $table->foreign('departamento_id')->references('departamento_id')->on('departamento');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bautizo');
    }
}
