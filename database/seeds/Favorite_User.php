<?php

use Illuminate\Database\Seeder;

class Favorite_User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites_user')->insert([
            'user_id'=>4,
            'favorite_id'=>1
        ]);
        DB::table('favorites_user')->insert([
            'user_id'=>4,
            'favorite_id'=>2
        ]);
        DB::table('favorites_user')->insert([
            'user_id'=>4,
            'favorite_id'=>4
        ]);
    }
}
