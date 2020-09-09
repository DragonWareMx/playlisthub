<?php

use Illuminate\Database\Seeder;

class Playlists extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('playlists')->insert([
            'tier' => 5,
            'tokens' => 2,
            'link_playlist' => 'https://open.spotify.com/playlist/6sSVRSUCRVJwSSTHnFmIfc?si=jQZfGuAxSzu5lRjI6Tj3aw',
            'user_id'=>2
        ]);
        DB::table('playlists')->insert([
            'tier' => 3,
            'tokens' => 1,
            'link_playlist' => 'https://open.spotify.com/playlist/3LQzcNIohGjtFo2a10vrmb',
            'user_id'=>2
        ]);
        DB::table('playlists')->insert([
            'tier' => 2.5,
            'tokens' => 2,
            'link_playlist' => 'https://open.spotify.com/playlist/0FzjuZcMMAY9vrkBmVARlR',
            'user_id'=>2
        ]);
    }
}
