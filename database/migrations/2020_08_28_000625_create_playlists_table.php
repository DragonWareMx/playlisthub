<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('tier', 2, 1);    //Nivel del playlist
            $table->unsignedSmallInteger('profits');  //Dinero que ha obtenido con la playlist
            $table->string('link_playlist')->unique();        //Link de spotify de la playlist
            $table->unsignedBigInteger('user_id');  //Musico que lanza la campaña

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
        Schema::dropIfExists('playlists');
    }
}
