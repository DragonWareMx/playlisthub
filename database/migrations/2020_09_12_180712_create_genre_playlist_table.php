<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenrePlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_playlist', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('playlist_id');

            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade');

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
        Schema::dropIfExists('genre_playlist');
    }
}
