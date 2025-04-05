<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipioTable extends Migration
{
    public function up()
    {
        Schema::create('municipio', function (Blueprint $table) {
            $table->increments('municipio_id');
            $table->string('municipio', 100);
            $table->integer('departamento_id')->unsigned();
            $table->timestamps();

            $table->foreign('departamento_id')->references('departamento_id')->on('departamento');
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipio');
    }
}
