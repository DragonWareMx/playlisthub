<?php

use Illuminate\Database\Seeder;

class Camps extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('camps')->insert([
            'start_date' => '2020-08-20',
            'end_date' => '2020-09-03',
            'cost' => 2,
            'link_song' => 'https://open.spotify.com/track/0RZVAhyB8vhxQz6ITjiuyA',
            'genre'=>'Metal',
            'review_id'=>1,
            'status'=>'aceptado',
            'user_id'=>1,
            'playlist_id'=>1
        ]);
        DB::table('camps')->insert([
            'start_date' => '2020-08-21',
            'end_date' => '2020-08-27',
            'cost' => 1,
            'link_song' => 'https://open.spotify.com/track/06Ij53zp29XcB6YFk11pqo?si=3BxV0l5kSQO3xDiDHCK7tA',
            'genre'=>'Rock',
            'review_id'=>2,
            'status'=>'rechazado',
            'user_id'=>1,
            'playlist_id'=>2
        ]);
        DB::table('camps')->insert([
            'start_date' => '2020-09-07',
            'cost' => 2,
            'link_song' => 'https://open.spotify.com/track/2wt6SfhOZbTO4WO9NMXZBV',
            'genre'=>'Rock en español',
            'status'=>'espera',
            'user_id'=>1,
            'playlist_id'=>3
        ]);
        DB::table('camps')->insert([
            'start_date' => '2020-09-08',
            'end_date' => '2020-09-25',
            'cost' => 2,
            'link_song' => 'https://open.spotify.com/track/0eVB5kmXBHSKgTYxgI77kq',
            'genre'=>'Metal',
            'review_id'=>3,
            'status'=>'aceptado',
            'user_id'=>1,
            'playlist_id'=>3
        ]);
        DB::table('camps')->insert([
            'start_date' => '2020-09-08',
            'end_date' => '2020-09-26',
            'cost' => 2,
            'link_song' => 'https://open.spotify.com/track/0i4ggi1qGPbr8OqaKBm5iY',
            'genre'=>'Pop',
            'review_id'=>4,
            'status'=>'aceptado',
            'user_id'=>1,
            'playlist_id'=>1
        ]);
    }
}
