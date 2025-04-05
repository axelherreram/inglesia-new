<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class personas extends Migration
{
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('persona_id')->unsigned();
            $table->string('nombres', 255);
            $table->string('apellidos', 255);
            $table->string('dpi_cui', 20)->unique();
            // $table->integer('municipio_id')->unsigned();
            $table->string('direccion', 255)->nullable();
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['M', 'F', 'O']);
            $table->string('num_telefono', 20)->nullable();
            $table->enum('tipo_persona', ['F', 'S', 'O'])->comment('F: Feligrés, S: Sacerdote, O: Otro');
            $table->integer('padre_id')->unsigned()->nullable();
            $table->integer('madre_id')->unsigned()->nullable();
            $table->integer('padrino_id')->unsigned()->nullable();
            $table->integer('madrina_id')->unsigned()->nullable();
            $table->timestamps(0);

            // Claves foráneas
            //$table->foreign('municipio_id')->references('municipio_id')->on('municipio');
            $table->foreign('padre_id')->references('persona_id')->on('personas');
            $table->foreign('madre_id')->references('persona_id')->on('personas');
            $table->foreign('padrino_id')->references('persona_id')->on('personas');
            $table->foreign('madrina_id')->references('persona_id')->on('personas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
