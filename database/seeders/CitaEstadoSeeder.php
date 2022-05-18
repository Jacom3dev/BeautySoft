<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('estado_cita')->insert([
        'name' => 'Cancelado',
        ]);
        DB::table('estado_cita')->insert([
        'name' => 'pendiente',
        ]);
        DB::table('estado_cita')->insert([
            'name' => 'en ejecucion',
            ]);
    }
}
