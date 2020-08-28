<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //REQUESTS es la entidad utilizada para las CAMPAÑAS
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('start_date');                             //fecha de inicio de la campaña
            $table->date('end_date')->nullable();                   //fecha de termino de la campaña
            $table->unsignedSmallInteger('cost');                   //el número de tokens que el musico utilizó para la campaña
            $table->string('link_song');                            //es el link de la canción de spotify
            $table->string('tags')->nullable();                     //Son los tags de la campaña
            $table->unsignedBigInteger('user_id');                  //Musico que lanza la campaña
            $table->unsignedBigInteger('playlist_id')->nullable();  //Playlist relacionada a la campaña

            //llave foranea del usuario
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //llave foranea del playlist
            $table->foreign('playlist_id')
            ->references('id')
            ->on('playlists')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
