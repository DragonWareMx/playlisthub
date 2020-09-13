<?php

use Illuminate\Database\Seeder;

class Genres extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name'=>'Pop'
        ]);
        DB::table('genres')->insert([
            'name'=>'Rock'
        ]);
        DB::table('genres')->insert([
            'name'=>'Metal'
        ]);
        DB::table('genres')->insert([
            'name'=>'Indie'
        ]);
        DB::table('genres')->insert([
            'name'=>'Hardcore'
        ]);
        DB::table('genres')->insert([
            'name'=>'Reguetón'
        ]);
        DB::table('genres')->insert([
            'name'=>'Cumbia'
        ]);
        DB::table('genres')->insert([
            'name'=>'Salsa'
        ]);
        DB::table('genres')->insert([
            'name'=>'Jazz'
        ]);
        DB::table('genres')->insert([
            'name'=>'Música Clásica'
        ]);
        DB::table('genres')->insert([
            'name'=>'Electrónica'
        ]);
        DB::table('genres')->insert([
            'name'=>'Dubstep'
        ]);
        DB::table('genres')->insert([
            'name'=>'Troba'
        ]);
        DB::table('genres')->insert([
            'name'=>'Ranchera'
        ]);
    }
}
