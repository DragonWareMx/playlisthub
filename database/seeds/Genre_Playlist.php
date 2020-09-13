<?php

use Illuminate\Database\Seeder;

class Genre_Playlist extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre_playlist')->insert([
            'genre_id'=>2,
            'playlist_id'=>1
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>4,
            'playlist_id'=>1
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>6,
            'playlist_id'=>1
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>7,
            'playlist_id'=>2
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>4,
            'playlist_id'=>2
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>8,
            'playlist_id'=>2
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>7,
            'playlist_id'=>3
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>3,
            'playlist_id'=>3
        ]);
        DB::table('genre_playlist')->insert([
            'genre_id'=>5,
            'playlist_id'=>3
        ]);
    }
}
