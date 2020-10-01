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
        $this->call(Playlists::class);
        $this->call(Camps::class);
        $this->call(Reviews::class);
        $this->call(Favorite_User::class);
        $this->call(PermissionSeeder::class);
        $this->call(Artists::class);
        $this->call(Artist_Playlist::class);
    }
}
