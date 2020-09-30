<?php

use Illuminate\Database\Seeder;

class Artists extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artists')->insert([
            'id_spotify' => '3WrFJ7ztbogyGnTHbHJFl2',
            'name'=>'The Beatles'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '09xj0S68Y1OU1vHMCZAIvz',
            'name'=>'Café Tacvba'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '27Owkm4TGlMqb0BqaEt3PW',
            'name'=>'Molotov'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '4Z8W4fKeB5YxbusRsdQVPb',
            'name'=>'Radiohead'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '1GImnM7WYVp95431ypofy9',
            'name'=>'Caifanes'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '6XyY86QOPPrYVGvF9ch6wz',
            'name'=>'Linkin Park'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '4B2Iosqk1yAbGbx08My1fM',
            'name'=>'Saurom'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '12Chz98pHFMPJEknJQMWvI',
            'name'=>'Muse'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '5GcWBUX00IPuWVGMIRK1sS',
            'name'=>'Residente'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '2896hxvEV5gs0WbAmT2qra',
            'name'=>'Adrián Gil'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '4gzpq5DPGxSnKTe4SA8HAU',
            'name'=>'Coldplay'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '6wWVKhxIU2cEi0K81v7HvP',
            'name'=>'Rammstein'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '2ye2Wgw4gimLv2eAKyk1NB',
            'name'=>'Metallica'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '5Hsv8dUHHOdnn72q4XIVz7',
            'name'=>'Leiva'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '6IdtcAwaNVAggwd6sCKgTI',
            'name'=>'Zoé'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '2QWIScpFDNxmS6ZEMIUvgm',
            'name'=>'Julieta Venegas'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '1mX1TWKpNxDSAH16LgDfiR',
            'name'=>'Jesse & Joy'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '5ZNxiPcbKgaNcBrERMpqeu',
            'name'=>'Mägo de Oz'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '1Qp56T7n950O3EGMsSl81D',
            'name'=>'Ghost'
        ]);
        DB::table('artists')->insert([
            'id_spotify' => '0nmQIMXWTXfhgOBdNzhGOs',
            'name'=>'Avenged Sevenfold'
        ]);
    }
}
