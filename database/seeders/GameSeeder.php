<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
                'gametitle' => 'VALORANT',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('games')->insert([
                'gametitle' => 'ApexLegends',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}