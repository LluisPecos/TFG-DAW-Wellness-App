<?php

namespace App\Classes;

use App\Classes\Utl;
use DB;

class Producto {
    
    private $uniqueProduct;
    private $userProducts;
    private $id_producto;
    private $id_usuario;
    
    function __construct($id_producto) {
        
        $searchProduct = DB::select("select 
                                     u.id_usuario, u.nombre as userName, u.apellidos, u.email, u.img_perfil, u.telefono,
                                     p.id_producto, p.precio, p.nombre as productName, p.descripcion, p.visitas, p.vendido, p.updated_at,
                                     c.categoria, e.estado, i.img0, i.img1, i.img2, i.img3, i.img4, i.img5, i.img6, i.img7
                                     from productos p
                                     join usuarios u on p.id_usuario = u.id_usuario
                                     join estados e on p.id_estado = e.id_estado
                                     join categorias c on p.id_categoria = c.id_categoria
                                     join imagenes i on p.id_producto = i.id_producto
                                     where p.id_producto = " . $id_producto);
        
        foreach($searchProduct as $detalles) {
            $this->id_producto = $detalles->id_producto;
            $this->id_usuario = $detalles->id_usuario;
        }
        
        $this->uniqueProduct = $searchProduct;
    }
    
    function getUniqueProduct() {
        return $this->uniqueProduct;
    }
    
    function getUserProducts() {
        return $this->userProducts;
    }
    
    function getFavoritesCount() {
        $favoritesCount = DB::select("select count(*) as favoritesCount from favoritos where id_producto = " . $this->id_producto);
        
        foreach($favoritesCount as $detalles) {
            return $detalles->favoritesCount;
        }
    }
    
    function getUserProductsCount() {
        $userProductsCount = DB::select("select count(*) as userProductsCount from productos where id_usuario = " . $this->id_usuario . " and vendido = false");
        
        if(count($userProductsCount) == 1) {
            foreach($userProductsCount as $detalles) {
                return $detalles->userProductsCount;
            }
        }
        
        return null;
    }
    
    function isProductLiked() {
        if(session()->has('id')) {
            $userProductLiked = DB::select('select * from favoritos where id_usuario = ' . session()->get('id') . ' and id_producto = ' . $this->id_producto);
        
            if(count($userProductLiked) == 1 && !empty($userProductLiked)) {
                return true;
            }
        }
        
        return false;
    }
}

?>