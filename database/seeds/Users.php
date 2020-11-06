<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'DragonWareOficial@hotmail.com',
            'password' => bcrypt('viledruid9000'),
            'genre'=>'m',
            'birth_date'=>'1997-12-27',
            'country'=>'Morelia',
            'tokens'=>0,
            'spotify_id'=>'administrador',
            'avatar'=>'https://playlisthub.io/wp-content/uploads/2020/03/letras-blancas-sin-fondo.png',
            'type'=>'Administrador'
        ]);
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'trenge01@gmail.com',
            'password' => bcrypt('12345678'),
            'genre'=>'m',
            'birth_date'=>'1997-12-27',
            'country'=>'Morelia',
            'tokens'=>0,
            'spotify_id'=>'administradorRaul',
            'avatar'=>'https://playlisthub.io/wp-content/uploads/2020/03/letras-blancas-sin-fondo.png',
            'type'=>'Administrador'
        ]);
    }
}
