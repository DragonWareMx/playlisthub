<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedTinyInteger('rating');  //Es el rating de la review (0.0 a 5.0) que son representados con estrellas
            $table->text('comment');              //Es el comentario de la review
            $table->date('date');                   //Fecha en que se publica la review
            $table->unsignedBigInteger('user_id');  //Usuario que realiza el review
            $table->unsignedBigInteger('playlist_id')->nullable();  //playlist

            //llave foranea del usuario
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //llave foranea del playlist
            $table->foreign('playlist_id')
                ->references('id')
                ->on('playlists')
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
        Schema::dropIfExists('reviews');
    }
}
