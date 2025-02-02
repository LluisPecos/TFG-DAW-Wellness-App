<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_usuario');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('contraseña');
            $table->string('img_perfil')->default('imgs/perfil/default.svg');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('genero', 1)->nullable();
            $table->integer('telefono')->nullable();
            $table->string('rol', 3)->default('usu');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            
            // $table->timestamps();
            // $table->rememberToken();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
