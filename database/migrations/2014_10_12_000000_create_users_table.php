<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');                             //Nombre completo del usuario
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->string('spotify_id')->unique();            //id del prefil de spotify
            $table->string('avatar');                          //foto de perfil 
            $table->string('type');

            $table->enum('genre', ['f', 'm','o']);              //Genero del usuario   
            $table->date('birth_date');                         //Fecha de nacimiento del usuario
            $table->string('country', 200);                     //Pais de origen del usuario

            $table->string('saldo')->nullable();
            $table->date('last_login')->nullable();
            $table->string('tokens')->nullable(); //Numero de tokens que un musico ha comprado/que el curador ha ganado
            $table->tinyInteger('premium')->default(0);         // identifica si el usuario es premium, 0 no premium, 1 sí premium
            $table->string('reference')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
