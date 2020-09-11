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
            'name' => 'Panchito Musician',
            'email' => 'panchittoMusician@hotmail.com',
            'password' => 'panchitomusician',
            'genre'=>'f',
            'birth_date'=>'1995-01-14',
            'country'=>'México',
            'tokens'=>7,
            'spotify_id'=>'Spotify',
            'avatar'=>'https://i.scdn.co/image/ab6775700000ee85b5d374d281b9e510eda15fdf',
            'type'=>'Músico'
        ]);
        DB::table('users')->insert([
            'name' => 'Oski Curator Maximum',
            'email' => 'oscarwaii@hotmail.com',
            'password' => 'viledruid9000',
            'genre'=>'m',
            'birth_date'=>'1997-12-27',
            'country'=>'Morelia',
            'tokens'=>27,
            'spotify_id'=>'viledruid',
            'avatar'=>'https://i.scdn.co/image/ab6775700000ee8555c25988a6ac314394d3fbf5',
            'type'=>'Curador'
        ]);
    }
}
