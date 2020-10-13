<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id',)->references('id')->on('users')->onDelete('cascade');        //id del usuario que usa la referencia
            $table->foreignId('referenced_id',)->references('id')->on('users')->onDelete('cascade');//id del usuario referenciado
            $table->timestamps();
            $table->unique(["user_id", "referenced_id"], 'user_referenced_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_references');
        Schema::table('users_references', function (Blueprint $table) {
            $table->dropUnique('user_referenced_unique');
          });
    }
}
