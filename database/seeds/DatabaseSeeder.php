<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Users::class);
        $this->call(Genres::class);
        $this->call(Playlists::class);
        $this->call(Reviews::class);
        $this->call(Camps::class);
        $this->call(Favorite_User::class);
        $this->call(Genre_Playlist::class);
    }
}
