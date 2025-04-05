<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatoGeneralParroquiaTable extends Migration
{
    public function up()
    {
        Schema::create('dato_general_parroquia', function (Blueprint $table) {
            $table->increments('dato_parroquia_id');
            $table->string('nombre_parroquia', 150);
            $table->string('direccion', 100);
            $table->string('num_telefono', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dato_general_parroquia');
    }
}
