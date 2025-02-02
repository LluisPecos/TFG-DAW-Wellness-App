<?php

namespace App\Classes;

use App\Classes\Utl;
use DB;

class Busqueda {
    
    private $resultadosBusqueda;
    private $busqueda;
    private $estado;
    private $categoria;
    private $minPrecio;
    private $maxPrecio;
    private $modificadoHace;
    private $offset;
    private $actualDate;
    
    function __construct($busqueda, $estado, $categoria, $minPrecio, $maxPrecio, $modificadoHace, $offset = null) {
        
        $this->busqueda = $busqueda;
        $this->estado = $estado;
        $this->categoria = $categoria;
        $this->minPrecio = $minPrecio;
        $this->maxPrecio = $maxPrecio;
        $this->modificadoHace = $modificadoHace;
        $this->offset = $offset;
        $this->actualDate = date("Y-m-d");
        
        $this->defaultFiltersValue();
        
        $buscarProductos = DB::select("select p.id_producto, p.precio, p.nombre, p.descripcion, i.img0
                                      from productos p
                                      join imagenes i on p.id_producto = i.id_producto
                                      where nombre like '%" . $this->busqueda . "%' and vendido = false 
                                      and (" . $this->categoria . " is null or id_categoria = " . $this->categoria . ")
                                      and (" . $this->estado . " is null or id_estado = " . $this->estado . ")
                                      and (precio >= " . $this->minPrecio . " and precio <= " . $this->maxPrecio . ")
                                      and (" . $this->modificadoHace . " is null or DATEDIFF('" . $this->actualDate . "', p.updated_at) <= " . $this->modificadoHace . ")
                                      order by nombre asc limit 20 offset " . $this->offset);
        
        $productos = [];
        
        foreach($buscarProductos as $producto) {
            $precio = Utl::formatPrice($producto->precio);
            $nombre = Utl::formatName($producto->nombre);
            $descripcion = Utl::formatDescription($producto->descripcion);
            
            $formattedProduct = [
                'id_producto' => $producto->id_producto,
                'precio' => $precio,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'img0' => $producto->img0,
            ];
            
            array_push($productos, $formattedProduct);
        }
        
        $this->resultadosBusqueda = $productos;
    }
    
    public function getSearchResults() {
        return $this->resultadosBusqueda;
    }
    
    private function defaultFiltersValue() {
        if(empty($this->estado)) {
            $this->estado = "null";
        }
        
        if(empty($this->categoria)) {
            $this->categoria = "null";
        }
        
        if(empty($this->minPrecio)) {
            $this->minPrecio = 0;
        }
        
        if(empty($this->maxPrecio)) {
            $this->maxPrecio = 99999999999.99;
        }
        
        if(empty($this->modificadoHace)) {
            $this->modificadoHace = 'null';
        }
        
        if(is_null($this->offset)) {
            $this->offset = 0;
        }
    }
}

?>