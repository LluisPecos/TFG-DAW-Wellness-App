<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id_producto');
            $table->unsignedBigInteger('id_usuario');
            $table->decimal('precio', $precision = 11, $scale = 2);
            $table->string('nombre');
            $table->unsignedInteger('id_categoria');
            $table->unsignedInteger('id_estado');
            $table->string('descripcion', 640)->nullable();
            $table->bigInteger('visitas')->default(0);
            $table->boolean('vendido')->default(false);
            $table->dateTime('fecha_vendido')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
            $table->foreign('id_estado')->references('id_estado')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
