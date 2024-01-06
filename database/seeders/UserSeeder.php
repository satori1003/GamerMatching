<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name' => 'さとみりゅうき',
                'email' => 'satoryu@gamil.com',
                'password' => 'satori',
                'date_of_birth' => '2002.10.03',
                'profile_image' => null,
                'bio' => '好きなゲームはValorantです。毎日ゲームします。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
    }
}
