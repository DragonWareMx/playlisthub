<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_review', function (Blueprint $table) {
            $table->id();
            $table->integer('request_id')->unsigned();
            $table->integer('review_id')->unsigned();
            $table->timestamps();

            //llave foranea del usuario
            $table->foreign('request_id')
                ->references('id')
                ->on('requests')
                ->onDelete('set null');

            //llave foranea del usuario
            $table->foreign('review_id')
            ->references('id')
            ->on('reviews')
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
        Schema::dropIfExists('request_review');
    }
}
