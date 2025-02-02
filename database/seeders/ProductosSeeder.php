<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar datos
        DB::table('productos')->insert([
            [
            'id_usuario' => 1,
            'precio' => 10000,
            'nombre' => 'SEAT Ibiza Rojo',
            'id_categoria' => 1,
            'id_estado' => 3,
            'descripcion' => 'Ha sufrido algunos rasguños en los laterales',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 1,
            'precio' => 80000,
            'nombre' => 'Tesla Model S',
            'id_categoria' => 1,
            'id_estado' => 2,
            'descripcion' => 'Coche Tesla sin ninún desperfecto',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 1,
            'precio' => 3000,
            'nombre' => 'Kawasaki Ninja 250',
            'id_categoria' => 2,
            'id_estado' => 2,
            'descripcion' => 'Moto Kawasaki bien cuidada y en buen estado',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 2,
            'precio' => 5000,
            'nombre' => 'Honda XR 150',
            'id_categoria' => 2,
            'id_estado' => 3,
            'descripcion' => 'Moto Honda algo usada pero en buen estado',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 2,
            'precio' => 77.67,
            'nombre' => 'Neumáticos Michelin 205/55 R16',
            'id_categoria' => 3,
            'id_estado' => 1,
            'descripcion' => 'Neumáticos nuevos sin usar',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 2,
            'precio' => 44.90,
            'nombre' => 'Gato hidráulico de carretilla de 3 toneladas',
            'id_categoria' => 3,
            'id_estado' => 2,
            'descripcion' => 'Capaz de soportar hasta 3 toneladas en muy buen estado',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 5,
            'precio' => 200,
            'nombre' => 'PS4 Slim',
            'id_categoria' => 10,
            'id_estado' => 1,
            'descripcion' => 'Se vende ps4 slim de 500gb en perfecto estado con todos sus accesorios, incluye 3 juegos y mando, se entrega con caja y en mano',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 1,
            'precio' => 42900,
            'nombre' => 'Lexus RC RC 300h Executive Navigation',
            'id_categoria' => 1,
            'id_estado' => 1,
            'descripcion' => "EQUIPAMIENTO DE SERIE - ABS - Acabados de lujo, cierre centralizado con mand. Lexus RC Coupe en Madrid",
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 4,
            'precio' => 1500,
            'nombre' => 'kymco superdink 125 abs',
            'id_categoria' => 2,
            'id_estado' => 3,
            'descripcion' => 'Vendo kymco superdink 125 con abs del 2013 la moto tiene 68000 kilómetros pero lleva un segundo motor con 30.000 kilómetros, mantenimiento al dia con cambio de correa, rodillos, batería, filtros, pastillas y aceite itv en vigor.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 6,
            'precio' => 20,
            'nombre' => 'Pastillas de preno Volvo v 40 año 2000 y s40',
            'id_categoria' => 3,
            'id_estado' => 1,
            'descripcion' => 'Pastillas preno Volvo v40',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 9,
            'precio' => 15,
            'nombre' => 'Chaqueta mujer moda',
            'id_categoria' => 4,
            'id_estado' => 2,
            'descripcion' => 'Chaqueta de mujer moderna de color negro. En perfecto estado. Talla 46.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 8,
            'precio' => 60,
            'nombre' => 'tv Samsung 32',
            'id_categoria' => 5,
            'id_estado' => 3,
            'descripcion' => 'Color negro buen estado, no es smartv pero funciona correctamente viene con soporte para pared incluido.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 3,
            'precio' => 60,
            'nombre' => 'Teléfono con tarjeta SIM, 3G, Bluetooth',
            'id_categoria' => 6,
            'id_estado' => 1,
            'descripcion' => 'Teléfono de sobremesa con tarjeta SIM Tecdesk NEO 3600. Pantalla LCD a color Bluetooth 2G / 3G Batería. Autonomía 3h de conversación y 150h de reposo Voz HD Altavoz - manos libres Fácil instalación Oferta por restos de lote. Teléfono valorado en 200€. Varias unidades',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 10,
            'precio' => 80,
            'nombre' => 'Tabla de deporte',
            'id_categoria' => 8,
            'id_estado' => 2,
            'descripcion' => 'En perfecto estado, tabla de abdominales, sin apenas uso en color negro',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            [
            'id_usuario' => 2,
            'precio' => 20,
            'nombre' => 'Bicicleta infantil',
            'id_categoria' => 9,
            'id_estado' => 2,
            'descripcion' => 'Vendo bicicleta infantil para 3-5 años. En perfecto estado y lista para usarse. Incluyo ruedines.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 5,
            'precio' => 120,
            'nombre' => 'Conjunto mesa y sillas',
            'id_categoria' => 11,
            'id_estado' => 3,
            'descripcion' => 'Conjunto mesa y 4 sillas, de hierro forjado con mesa de mármol, las sillas son muy cómodas.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 4,
            'precio' => 220,
            'nombre' => 'Lavavajillas',
            'id_categoria' => 12,
            'id_estado' => 4,
            'descripcion' => 'Lavavajillas de 45 cm, no tiene más de 2 años.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            [
            'id_usuario' => 3,
            'precio' => 50,
            'nombre' => 'Película el gran MClintock',
            'id_categoria' => 13,
            'id_estado' => 2,
            'descripcion' => 'Aun plastificada. El gran MClintock.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 1,
            'precio' => 10,
            'nombre' => 'Parque de bebes',
            'id_categoria' => 14,
            'id_estado' => 3,
            'descripcion' => 'Parque de bebés con manta acolchada',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 10,
            'precio' => 35,
            'nombre' => 'Juego de construcción',
            'id_categoria' => 16,
            'id_estado' => 5,
            'descripcion' => 'Una caja grande con muchas piezas para construir lo que te enseña el manual... Helicoptero, hoovercraft, auto de carera, maquina de construcción. Algunas piezas faltan, como la cuarta llanta.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],

            [
            'id_usuario' => 6,
            'precio' => 20,
            'nombre' => 'Jaula para pájaro',
            'id_categoria' => 17,
            'id_estado' => 4,
            'descripcion' => 'Jaula metálica',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 7,
            'precio' => 10,
            'nombre' => 'RAM SDRAM DDR2 240 pines 1GB x4 (4GB en total)',
            'id_categoria' => 7,
            'id_estado' => 3,
            'descripcion' => 'Samsung Número de parte: m378t2953ez3-ce6 Tipo de bus: PC2-5300U Corrección de errores: Non-ECC Tiempo de ciclo: 6ns CAS: CL5 Velocidad de transferencia de datos: 667MHz Memory Clock: 166MHz Voltaje: 1.8 Garantía total. Si no quedas conforme te devuelvo el dinero.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ],
            
            [
            'id_usuario' => 7,
            'precio' => 100,
            'nombre' => 'Casco speedairo RS talla M 54-59',
            'id_categoria' => 8,
            'id_estado' => 4,
            'descripcion' => 'Casco ciclismo triatlón de la marca alemana Cas-co Speed airo RS.Talla M 54-59 cm color negro y rojo . Usado para un triatlón. 2 visores y manuales de instrucciones. Como nuevo, no negociable.',
            'created_at'=> "2021-06-20 16:29:23",
            'updated_at'=> "2021-06-20 16:29:23"
            ]
        ]);
    }
}
