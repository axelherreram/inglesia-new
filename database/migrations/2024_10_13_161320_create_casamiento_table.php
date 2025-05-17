<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasamientoTable extends Migration
{
    public function up()
    {
        Schema::create('casamientos', function (Blueprint $table) {
            $table->increments('casamiento_id')->unsigned();
            $table->string('NoPartida', 20);
            $table->string('folio', 50);
            $table->dateTime('fecha_casamiento');
            $table->string('origen_esposo', 255);
            $table->string('feligresesposo', 255)->nullable();
            $table->string('origen_esposa', 255);
            $table->string('feligresesposa', 255)->nullable();
            $table->unsignedInteger('esposo_id');
            $table->unsignedInteger('esposa_id');
            $table->unsignedInteger('sacerdote_id');
            $table->unsignedInteger('padre_esposo_id')->nullable();
            $table->unsignedInteger('madre_esposo_id')->nullable();
            $table->unsignedInteger('padre_esposa_id')->nullable();
            $table->unsignedInteger('madre_esposa_id')->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('esposo_id')->references('persona_id')->on('personas');
            $table->foreign('esposa_id')->references('persona_id')->on('personas');
            $table->foreign('sacerdote_id')->references('persona_id')->on('personas');
            $table->foreign('padre_esposo_id')->references('persona_id')->on('personas');
            $table->foreign('madre_esposo_id')->references('persona_id')->on('personas');
            $table->foreign('padre_esposa_id')->references('persona_id')->on('personas');
            $table->foreign('madre_esposa_id')->references('persona_id')->on('personas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('casamientos');
    }
}
