<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BorrarProductoController extends Controller
{
    // Borrar producto
    function borrarProductos(Request $request){
        
        $productos = $request->productos;
        
        if(!empty($productos)) {
            
            $arrProductos = explode(",", $productos);
            
            $multipleProducts = false;
            if(count($arrProductos) > 1) {
                $multipleProducts = true;
            }
            
            $areAllNumbers = true;
            foreach($arrProductos as $id_producto) {
                if(!is_numeric($id_producto)) {
                    $areAllNumbers = false;
                }
            }
            
            if($areAllNumbers == true) {
                $ownerVerified = true;
                
                $searchOwner = DB::select('select id_usuario from productos where id_producto in (' . $productos . ')');
                
                foreach($searchOwner as $producto) {
                    if($producto->id_usuario != $request->session()->get('id')) {
                        $ownerVerified = false;
                    }
                }
                
                if($ownerVerified == true && count($searchOwner) >= 1) {

                    // Borrar imágenes de los productos
                    $productsImgs = DB::select('select * from imagenes where id_producto in(' . $productos . ')');

                    if($productsImgs) {
                        foreach($productsImgs as $imgs) {

                            for($i = 0; $i < 8; $i++) {
                                $deleteImg = "img" . $i;
                                $imgDir = public_path() . $imgs->$deleteImg;

                                if(is_file($imgDir)) {
                                    unlink($imgDir);
                                }
                            }

                            $files_in_directory = scandir(public_path() . "/imgs/productos/" . session()->get('id') . "/" . $imgs->id_producto);
                            $items_count = count($files_in_directory);

                            if ($items_count <= 2) {
                                rmdir(public_path() . "/imgs/productos/" . session()->get('id') . "/" . $imgs->id_producto);
                            }

                            $files_in_directory = scandir(public_path() . "/imgs/productos/" . session()->get('id'));
                            $items_count = count($files_in_directory);

                            if ($items_count <= 2) {
                                rmdir(public_path() . "/imgs/productos/" . session()->get('id'));
                            }
                        }

                        // Borrar producto de la base de datos
                        $deleteProducts = DB::delete("delete from productos where id_producto in (" . $productos . ") and id_usuario = " . $request->session()->get('id'));

                        if($deleteProducts) {
                            if($multipleProducts == true) {
                                $request->session()->flash('mensajeExito', 'Productos eliminados');
                            } else {
                                $request->session()->flash('mensajeExito', 'Producto eliminado');
                            }
                        } else {
                            if($multipleProducts == true) {
                                $request->session()->flash('mensajeError', 'Error al eliminar los productos');
                            } else {
                                $request->session()->flash('mensajeError', 'Error al eliminar el producto');
                            }
                        }
                    }

                } else {
                    if($multipleProducts == true) {
                        $request->session()->flash('mensajeError', 'No eres el propietario de los productos');
                    } else {
                        $request->session()->flash('mensajeError', 'No eres el propietario del producto');
                    }
                }
            }
            else
            {
                $request->session()->flash('mensajeError', 'Productos inválidos');
            }
        }
        else
        {
            $request->session()->flash('mensajeError', 'No se ha especificado ningún producto');
        }
        
        return redirect("/mis-productos");
    }
}
