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
            'profits' => 2,
            'link_playlist' => 'https://open.spotify.com/playlist/37i9dQZF1DXcBWIGoYBM5M',
            'user_id'=>2
        ]);
        DB::table('playlists')->insert([
            'tier' => 3,
            'profits' => 1,
            'link_playlist' => 'https://open.spotify.com/playlist/37i9dQZF1DX8FwnYE6PRvL',
            'user_id'=>2
        ]);
        DB::table('playlists')->insert([
            'tier' => 2.5,
            'profits' => 2,
            'link_playlist' => 'https://open.spotify.com/playlist/6CWhQMDzDzUyk3e2gmvNeY',
            'user_id'=>2
        ]);
    }
}
