<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class InsertarProductoController extends Controller
{
    // Subir/insertar producto
    function subirProducto() {
        if(session()->has('id') && !empty(session()->get('id'))) {
            $producto = array();
            $categorias = DB::select("select * from categorias");
            $estados = DB::select("select * from estados");
            return view("subirEditar-producto", ['categorias'=>$categorias, 'estados'=>$estados, 'producto'=>$producto]);
        } else {
            return view("perfil-no-sesion");
        }
    }
    
    // Insertar producto
    function insertarProducto(Request $request) {
        
        $this->validate($request, [
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'numeric'],
            'precio' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'estado' => ['required', 'numeric'],
            'descripcion' => ['nullable', 'string', 'max:640'],
            'img0' => ['image', 'mimes:jpeg,jpg,png', 'required', 'max:1024'],
            "optional.*" => ['image', 'mimes:jpeg,jpg,png', 'nullable', 'max:1024'],
        ]);
        
        $nombre = $request->nombre;
        $categoria = $request->categoria;
        $precio = $request->precio;
        $estado = $request->estado;
        $descripcion = $request->descripcion;
        
        $insertarProducto = DB::insert("insert into productos (id_usuario, nombre, id_categoria, precio, id_estado, descripcion, created_at, updated_at) values (" . $request->session()->get('id') . ", '" . $nombre . "', " . $categoria . ", " . $precio . ", " . $estado . ", '" . $descripcion . "', now(), now())");
        
        if ($insertarProducto) {
            // Último producto insertado
            $lastInsertedProduct = DB::select("select max(id_producto) as lastProductId from productos where id_usuario = " . session()->get('id'));
            
            $id_producto;
            
            foreach($lastInsertedProduct as $producto) {
                $id_producto = $producto->lastProductId;
            }
            
            // Imgs request
            $requiredImg = $request->file('img0');
            $optionalImgs = $request->file('optional');
            
            $arrayImgs = array();
            
            array_push($arrayImgs, $requiredImg);
            
            if($optionalImgs != null) {
                foreach($optionalImgs as $img) {
                    array_push($arrayImgs, $img);
                }
            }
            
            $path = public_path() . "/imgs/productos/" . session()->get('id') . "/" . $id_producto . "/";
            $dbPath = "/imgs/productos/" . session()->get('id') . "/" . $id_producto . "/"; 
            
            $imagesDbUrl = array();
            
            for($i = 0; $i < sizeof($arrayImgs); $i++) {
                $fileName = $i . "." . $arrayImgs[$i]->getClientOriginalExtension();
                
                if($arrayImgs[$i]->move($path, $fileName)) {
                    array_push($imagesDbUrl, $dbPath . $fileName);
                } else {
                    session()->flash('mensajeError', 'Error al guardar las imágenes');
                    return back();
                }
            }
            
            for($i = 0; $i < 8; $i++) {
                ${"img" . $i} = (isset($imagesDbUrl[$i]) ? "'$imagesDbUrl[$i]'" : 'null');
            }
            
            $insertarImagenes = DB::insert("insert into imagenes(id_producto, img0, img1, img2, img3, img4, img5, img6, img7) values(" . $id_producto . ", " . $img0 . ", " . $img1 . ", " . $img2 . ", " . $img3 . ", " . $img4 . ", " . $img5 . ", " . $img6 . ", " . $img7 . ")");
            
            if($insertarImagenes) {
                session()->flash('mensajeExito', 'Producto publicado');
            } else {
                session()->flash('mensajeError', 'Error al publicar el producto');
            }
            
            return back();
            
        } else {
            $request->session()->flash('mensajeError', 'Ha surgido un error inesperado al insertar el producto');
        }

        return back();
    }
}
