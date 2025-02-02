<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar datos
        DB::table('estados')->insert([
            [
            'estado' => 'Nuevo'
            ],
            
            [
            'estado' => 'Casi nuevo'
            ],
            
            [
            'estado' => 'En buen estado'
            ],
            
            [
            'estado' => 'En condiciones aceptables'
            ],
            
            [
            'estado' => 'Lo ha dado todo'
            ]
        ]);
    }
}
