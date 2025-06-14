<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class testigos extends Migration
{
    public function up()
    {
        Schema::create('testigos', function (Blueprint $table) {
            $table->increments('testigo_id')->unsigned();
            $table->integer('casamiento_id')->unsigned();
            $table->integer('persona_id')->unsigned();
            $table->timestamps(0);

            // Claves foráneas
            $table->foreign('casamiento_id')->references('casamiento_id')->on('casamientos');
            $table->foreign('persona_id')->references('persona_id')->on('personas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('testigos');
    }
}