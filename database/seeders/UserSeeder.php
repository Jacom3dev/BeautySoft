<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('Users')->insert([
            'name' => 'prueba',
            'email' => 'softwaresena2021@gmail.com',
            'cell' => '3245763609',
            'direction' => 'cll97',
            'state' => '1',
            'rol_id' => '1',
            'password' => bcrypt('2021soft'),
        ]);

    }
}
