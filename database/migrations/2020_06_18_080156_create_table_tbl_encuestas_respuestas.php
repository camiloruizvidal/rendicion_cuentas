<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblEncuestasRespuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_encuestas_respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tbl_encuestas_preguntas');
            $table->string('respuestas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_encuestas_respuestas');
    }
}
