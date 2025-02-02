<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        // Solo ejecutar un seeder
        php artisan db:seed --class=CategoriaSeeder
        
        // Desactivar revisión de claves foráneas
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('categorias')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas
        */
        
        // Insertar datos
        DB::table('categorias')->insert([
            [
            'categoria' => 'Coches'
            ],
            
            [
            'categoria' => 'Motos'
            ],
            
            [
            'categoria' => 'Motor y Accesorios'
            ],
            
            [
            'categoria' => 'Moda y Accesorios'
            ],
            
            [
            'categoria' => 'TV, Audio y Foto'
            ],
            
            [
            'categoria' => 'Móviles y Telefonía'
            ],
            
            [
            'categoria' => 'Informática y Electrónica'
            ],
            
            [
            'categoria' => 'Deporte y Ocio'
            ],
            
            [
            'categoria' => 'Bicicletas'
            ],
            
            [
            'categoria' => 'Consolas y Videojuegos'
            ],
            
            [
            'categoria' => 'Hogar y Jardín'
            ],
            
            [
            'categoria' => 'Electrodomésticos'
            ],
            
            [
            'categoria' => 'Cine, Libros y Música'
            ],
            
            [
            'categoria' => 'Niños y Bebes'
            ],
            
            [
            'categoria' => 'Coleccionismo'
            ],
            
            [
            'categoria' => 'Materiales de construcción'
            ],
            
            [
            'categoria' => 'Industria y Agricultura'
            ],
            
            [
            'categoria' => 'Otros'
            ]
        ]);
    }
}
