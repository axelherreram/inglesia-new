<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasamientoTable extends Migration
{
    public function up()
    {
        Schema::create('casamiento', function (Blueprint $table) {
            $table->increments('casamiento_id');
            $table->string('NoPartida', 20);
            $table->string('folio', 50);
            $table->dateTime('fecha_casamiento');
            $table->text('nombres_testigos');
            $table->string('nombre_esposo', 255);
            $table->string('edad_esposo', 4);
            $table->string('origen_esposo', 255);
            $table->string('feligresesposo', 255)->nullable();
            $table->string('nombre_padre_esposo', 255)->nullable();
            $table->string('nombre_madre_esposo', 255)->nullable();
            $table->string('nombre_esposa', 255);
            $table->string('edad_esposa', 4);
            $table->string('origen_esposa', 255);
            $table->string('feligresesposa', 255)->nullable();
            $table->string('nombre_padre_esposa', 255)->nullable();
            $table->string('nombre_madre_esposa', 255)->nullable();
            $table->string('nombre_parroco', 255);
            $table->integer('dato_parroquia_id')->unsigned();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('dato_parroquia_id')->references('dato_parroquia_id')->on('dato_general_parroquia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('casamiento');
    }
}
