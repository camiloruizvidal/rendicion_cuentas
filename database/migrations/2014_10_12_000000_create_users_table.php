<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_primero');
            $table->string('nombre_segundo')->nullable();
            $table->string('apellido_primero');
            $table->string('apellido_segundo')->nullable();
            $table->string('documento');
            $table->string('direccion')->nullable();
            $table->string('celular')->nullable();
            $table->integer('activo');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rol');
            $table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('id_usuario_deleted_att')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
