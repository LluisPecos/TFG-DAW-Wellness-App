<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_producto');
            $table->dateTime('fecha_adicion');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->unique(['id_usuario', 'id_producto']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoritos');
    }
}
