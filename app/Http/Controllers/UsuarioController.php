<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classes\Utl;
use DB;

class UsuarioController extends Controller
{
    function usuario($id = null) {
        if($id != null) {
            
            /*
            $data = ['id' => $id];
            
            Validator::make($data, [
                'id' => ['required', 'numeric']
            ])->validate();
            */
            
            if(is_numeric($id)) {
                
                $datosUsuario = DB::select("select img_perfil, nombre, apellidos,
                                            (select count(*) from productos where id_usuario = " . $id . " and vendido = false) as countProductosEnVenta,
                                            (select count(*) from productos where id_usuario = " . $id . " and vendido = true) as countProductosVendidos 
                                            from usuarios
                                            where id_usuario = " . $id);
                
                $countProductosEnVenta;
                $countProductosVendidos;
                
                foreach($datosUsuario as $dato) {
                    $countProductosEnVenta = $dato->countProductosEnVenta;
                    $countProductosVendidos = $dato->countProductosVendidos;
                }
                
                $searchProductos = DB::select("select p.id_producto, p.precio, p.nombre, p.descripcion, p.vendido, i.img0
                                               from usuarios u
                                               join productos p on u.id_usuario = p.id_usuario
                                               join imagenes i on p.id_producto = i.id_producto
                                               where p.id_usuario = " . $id . "
                                               order by p.updated_at desc");
                
                $productos = array();
                
                foreach($searchProductos as $producto) {
                    $precio = Utl::formatPrice($producto->precio);
                    $nombre = Utl::formatName($producto->nombre);
                    $descripcion = Utl::formatDescription($producto->descripcion);
                    
                    $formattedProduct = [
                        'id_producto' => $producto->id_producto,
                        'precio' => $precio,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'vendido' => $producto->vendido,
                        'img0' => $producto->img0,
                    ];
                    
                    array_push($productos, $formattedProduct);
                }
                
                if($datosUsuario && count($datosUsuario) == 1) {
                    return view('usuario', ['datosUsuario'=>$datosUsuario, 'productos'=>$productos, 'countProductosEnVenta'=>$countProductosEnVenta,'countProductosVendidos'=>$countProductosVendidos]);
                }
            }
        }
        
        session()->flash('mensajeError', 'Usuario no encontrado');
        return redirect("/");
    }
}
