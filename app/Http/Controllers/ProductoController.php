<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Utl;
use DB;
use App\Classes\Producto;

class ProductoController extends Controller
{
    function mostrarProducto(Request $request, $id_producto) {
        
        if(is_numeric($id_producto)) {
            
            $producto = new Producto($id_producto);
            $uniqueProduct = $producto->getUniqueProduct();
            
            if($uniqueProduct && sizeof($uniqueProduct) == 1) {
                
                $productNull = true;
                
                foreach($uniqueProduct as $detalles) {
                    if($detalles->id_usuario != null) {
                        $productNull = false;
                    }
                }
                
                if($productNull == false) {
                    $infoProducto = array();
                
                    foreach($uniqueProduct as $detalles) {
                        $precio = Utl::formatPrice($detalles->precio);
                        $updated_at = Utl::formatDate($detalles->updated_at);

                        $imgs = 
                            [
                            'img0' => $detalles->img0,
                            'img1' => $detalles->img1,
                            'img2' => $detalles->img2,
                            'img3' => $detalles->img3,
                            'img4' => $detalles->img4,
                            'img5' => $detalles->img5,
                            'img6' => $detalles->img6,
                            'img7' => $detalles->img7,
                            ];

                        $formattedProduct =
                            [
                            'id_usuario' => $detalles->id_usuario,
                            'userName' => $detalles->userName,
                            'apellidos' => $detalles->apellidos,
                            'email' => $detalles->email,
                            'img_perfil' => $detalles->img_perfil,
                            'telefono' => $detalles->telefono,
                            'id_producto' => $detalles->id_producto,
                            'precio' => $precio,
                            'productName' => $detalles->productName,
                            'descripcion' => $detalles->descripcion,
                            'visitas' => $detalles->visitas,
                            'vendido' => $detalles->vendido,
                            'updated_at' => $updated_at,
                            'categoria' => $detalles->categoria,
                            'estado' => $detalles->estado,
                            'imgs' => $imgs,
                            ];
                                

                        array_push($infoProducto, $formattedProduct);
                    }
                    
                    $favoritesCount = $producto->getFavoritesCount();
                    $userProductsCount = $producto->getUserProductsCount();
                    $userProductLiked = $producto->isProductLiked();
                    
                    $estados = DB::select("select * from estados");
                    $categorias = DB::select("select * from categorias");
                    
                    return view('producto', ['producto'=>$infoProducto, 'favoritesCount'=>$favoritesCount, 'userProductsCount'=>$userProductsCount, 'userProductLiked'=>$userProductLiked, "estados"=>$estados, "categorias"=>$categorias, 'request'=>$request]);
                }
            }
        }
        
        session()->flash('mensajeError', 'Producto no encontrado');
        return redirect("/");
    }
    
    // Incrementar número de visitas
    function incrementarVisitas(Request $request) {
        
        $id_producto = $request->id_producto;
        
        $incrementarVisitas = DB::update('update productos set visitas = visitas + 1 where id_producto = ' . $id_producto);
        
        if($incrementarVisitas) {
            return "Visita incrementada";
        } else {
            return "Error al incrementar la visita";
        }
    }
    
    // Todos los productos del usuario
    function productosUsuario() {
        if(session()->has('id')) {
            
            $searchProductos = DB::select("select p.id_producto, p.precio, p.nombre, p.vendido, p.fecha_vendido, p.created_at, p.updated_at, i.img0
                                          from productos p
                                          join imagenes i
                                          on p.id_producto = i.id_producto
                                          where p.id_usuario = " . session()->get('id') . " order by p.updated_at desc");
            
            $countProductos = DB::select("select
                                          (select count(*) from productos where id_usuario = " . session()->get('id') . " and vendido = false) as productosEnVenta,
                                          (select count(*) from productos where id_usuario = " . session()->get('id') . " and vendido = true) as productosVendidos
                                          from productos
                                          where id_usuario = " . session()->get('id') . "
                                          group by id_usuario");
            
            $countProductosEnVenta = 0;
            $countProductosVendidos = 0;
            
            foreach($countProductos as $count) {
                $countProductosEnVenta = $count->productosEnVenta;
                $countProductosVendidos = $count->productosVendidos;
            }
            
            $productos = array();

            foreach($searchProductos as $producto) {
                $nombre = Utl::formatName($producto->nombre);
                $precio = Utl::formatPrice($producto->precio);
                $created_at = Utl::formatDate($producto->created_at);
                $updated_at = Utl::formatDate($producto->updated_at);
                $fecha_vendido = Utl::formatDate($producto->fecha_vendido);

                $formattedProduct =
                    array(
                        'id_producto' => $producto->id_producto,
                        'precio' => $precio,
                        'nombre' => $nombre,
                        'vendido' => $producto->vendido,
                        'fecha_vendido' => $fecha_vendido,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                        'img0' => $producto->img0
                    );

                array_push($productos, $formattedProduct);
            }
            
            return view("mis-productos", ['productos'=>$productos, 'countProductosEnVenta'=>$countProductosEnVenta, 'countProductosVendidos'=>$countProductosVendidos]);
        } else {
            return view('perfil-no-sesion');
        }
    }
    
    // Vender producto
    function venderProducto(Request $request) {
        $id_producto = $request->id_producto;
        
        $searchOwner = DB::select("select id_usuario from productos where id_producto = " . $id_producto . " and id_usuario = " . $request->session()->get('id'));
        
        if(count($searchOwner) == 1) {
            
            $updateProduct = DB::update("update productos set vendido = true, fecha_vendido = now() where id_producto = " . $id_producto . " and id_usuario = " . session()->get('id'));
        
            if($updateProduct) {
                session()->flash('mensajeExito', 'Producto marcado como vendido');
            } else {
                session()->flash('mensajeError', 'No se ha podido marca el producto como vendido');
            }
            return back();
        }
        
        session()->flash('mensajeError', 'No eres el propietario del producto');
        return back();
    }
    
    // Obtener propietario del producto
    function getProductOwner($id_producto) {
        $searchOwner = DB::select("select id_usuario from productos where id_producto = " . $id_producto);
        $owner = null;
        foreach($searchOwner as $product) {
            $owner = $product->id_usuario;
        }
        return $owner;
    }
}
