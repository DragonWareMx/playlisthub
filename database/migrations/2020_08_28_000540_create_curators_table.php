<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curators', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('link_spotify');             //Es el link del perfil de curador en spotify
            $table->unsignedSmallInteger('profit');     //Es la cantidad de tokens que el curador ha ganado en campañas
            $table->unsignedBigInteger('user_id');      //Usuario

            //llave foranea del usuario
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curators');
    }
}
