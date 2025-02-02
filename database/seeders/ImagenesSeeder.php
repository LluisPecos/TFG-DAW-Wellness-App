<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imagenes')->insert([
            [
            'id_producto' => 1,
            'img0' => '/imgs/productos/1/1/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 2,
            'img0' => '/imgs/productos/1/2/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 3,
            'img0' => '/imgs/productos/1/3/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 4,
            'img0' => '/imgs/productos/2/4/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 5,
            'img0' => '/imgs/productos/2/5/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 6,
            'img0' => '/imgs/productos/2/6/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 7,
            'img0' => '/imgs/productos/5/7/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 8,
            'img0' => '/imgs/productos/1/8/0.jpeg',
            'img1' => '/imgs/productos/1/8/1.jpeg'
            ],
            
            [
            'id_producto' => 9,
            'img0' => '/imgs/productos/4/9/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 10,
            'img0' => '/imgs/productos/6/10/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 11,
            'img0' => '/imgs/productos/9/11/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 12,
            'img0' => '/imgs/productos/8/12/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 13,
            'img0' => '/imgs/productos/3/13/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 14,
            'img0' => '/imgs/productos/10/14/0.png',
            'img1' => null
            ],
            
            [
            'id_producto' => 15,
            'img0' => '/imgs/productos/2/15/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 16,
            'img0' => '/imgs/productos/5/16/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 17,
            'img0' => '/imgs/productos/4/17/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 18,
            'img0' => '/imgs/productos/3/18/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 19,
            'img0' => '/imgs/productos/1/19/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 20,
            'img0' => '/imgs/productos/10/20/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 21,
            'img0' => '/imgs/productos/6/21/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 22,
            'img0' => '/imgs/productos/7/22/0.jpg',
            'img1' => null
            ],
            
            [
            'id_producto' => 23,
            'img0' => '/imgs/productos/7/23/0.jpg',
            'img1' => null
            ],
            
        ]);
    }
}
