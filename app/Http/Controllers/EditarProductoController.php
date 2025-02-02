<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EditarProductoController extends Controller
{
    // Editar/actualizar producto
    function editarProducto($id) {
        if(session()->has('id') && !empty(session()->get('id'))) {
            
            if(is_numeric($id)) {
                
                $producto = DB::select("select p.id_producto, p.precio, p.nombre, p.id_categoria, p.id_estado, p.descripcion,
                                        i.img0, i.img1, i.img2, i.img3, i.img4, i.img5, i.img6, i.img7
                                        from productos p 
                                        join imagenes i on p.id_producto = i.id_producto
                                        where p.id_producto = " . $id . " and p.id_usuario = " . session()->get('id') . " and p.vendido = false");
                
                if(count($producto) == 1) {
                    
                    $categorias = DB::select("select * from categorias");
                    $estados = DB::select("select * from estados");
                    
                    foreach($producto as $datos) {
                        $imgs = 
                            [
                            'img0' => $datos->img0,
                            'img1' => $datos->img1,
                            'img2' => $datos->img2,
                            'img3' => $datos->img3,
                            'img4' => $datos->img4,
                            'img5' => $datos->img5,
                            'img6' => $datos->img6,
                            'img7' => $datos->img7
                            ];
                    }
                    
                    return view("subirEditar-producto", ['producto'=>$producto, 'imgs'=>$imgs, 'estados'=>$estados, 'categorias'=>$categorias]);
                }
            }
            return redirect('/');
            
        } else {
            return view('perfil-no-sesion');
        }
    }
    
    // Actualizar producto
    function actualizarProducto(Request $request) {
        
        $this->validate($request, [
            'id_producto' => ['required', 'numeric'],
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'numeric'],
            'precio' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'estado' => ['required', 'numeric'],
            'descripcion' => ['nullable', 'string', 'max:640'],
            'img0' => ['image', 'mimes:jpeg,jpg,png', 'nullable', 'max:1024'],
            'optional.*' => ['image', 'mimes:jpeg,jpg,png', 'nullable', 'max:1024'],
            'deleteImg1' => ['boolean'],
            'deleteImg2' => ['boolean'],
            'deleteImg3' => ['boolean'],
            'deleteImg4' => ['boolean'],
            'deleteImg5' => ['boolean'],
            'deleteImg6' => ['boolean'],
            'deleteImg7' => ['boolean']
        ]);
        
        $id_producto = $request->id_producto;
        $nombre = $request->nombre;
        $categoria = $request->categoria;
        $precio = $request->precio;
        $estado = $request->estado;
        $descripcion = $request->descripcion;
        
        $searchProductImgs = DB::select("select i.* from imagenes i 
                                         join productos p on i.id_producto = p.id_producto
                                         where i.id_producto = " . $id_producto . " and p.id_usuario = " . $request->session()->get('id'));
        
        if($searchProductImgs && count($searchProductImgs) == 1) {
            // Imgs request
            $requiredImg = $request->file('img0');
            $optionalImgs = $request->file('optional');

            $path = public_path() . "/imgs/productos/" . session()->get('id') . "/" . $id_producto . "/";
            $dbPath = "/imgs/productos/" . session()->get('id') . "/" . $id_producto . "/"; 

            if(is_file($requiredImg)) {
                foreach($searchProductImgs as $productImgs) {
                    if(isset($productImgs->img0)) {
                        $fileName = "0." . $requiredImg->getClientOriginalExtension();
                        
                        if(unlink(public_path() . $productImgs->img0)) {
                            if($requiredImg->move($path, $fileName)) {
                                DB::update("update imagenes set img0 = '" . $dbPath . $fileName . "' where id_producto = " . $id_producto);
                            }
                        }
                    }
                }
            }

            // Borrar imágenes opcionales y actualizar BD
            for($i = 1; $i <= 7; $i++) {

                $deleteImg = "deleteImg" . $i;

                // Si bool deleteImg == true
                if(isset($request->$deleteImg) && $request->$deleteImg == true) {

                    $imgDelete = "img" . $i;

                    foreach($searchProductImgs as $productImgs) {
                        if(isset($productImgs->$imgDelete)) {
                            unlink(public_path() . $productImgs->$imgDelete);

                            DB::update("update imagenes set " . $imgDelete . " = null where id_producto = " . $id_producto);
                        }
                    }
                }
            }

            // Borrar imágenes opcionales, guardar las nuevas imágenes y actualizar BD
            if(isset($optionalImgs)) {
                for($i = 0; $i < 8; $i++) {
                    // Si existe la imágen nueva en el array de optionalImgs
                    if(array_key_exists($i, $optionalImgs)) {

                        $fileName = ($i+1) . "." . $optionalImgs[$i]->getClientOriginalExtension();
                        $imgDelete = "img" . ($i+1);

                        foreach($searchProductImgs as $productImgs) {
                            if(isset($productImgs->$imgDelete)) {
                                unlink(public_path() . $productImgs->$imgDelete);
                            }
                        }
                        
                        if($optionalImgs[$i]->move($path, $fileName)) {
                            DB::update("update imagenes set " . $imgDelete . " = '" . $dbPath . $fileName . "' where id_producto = " . $id_producto);
                        }
                    }
                }
            }

            $actualizarProducto = DB::update("update productos set nombre = '" . $nombre . "', id_categoria = " . $categoria . ", precio = " . $precio . ", id_estado = " . $estado . ", descripcion = '" . $descripcion . "', updated_at = now() where id_producto = " . $id_producto . " and id_usuario = " . $request->session()->get('id'));

            $request->session()->flash('mensajeExito', 'Producto actualizado');
            return back();
        }
        
        $request->session()->flash('mensajeError', 'No eres el propietario del producto');
        return back();
    }
}
