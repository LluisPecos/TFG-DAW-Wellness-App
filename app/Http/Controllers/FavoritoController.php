<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Utl;
use DB;

class FavoritoController extends Controller
{
    // Favoritos
    function favoritos() {
        if(session()->has('id')) {
            $searchFavoritos = DB::select("select p.id_producto, p.precio, p.nombre, p.updated_at, p.vendido, p.fecha_vendido, i.img0, f.fecha_adicion                                from favoritos f 
                                           join productos p on f.id_producto = p.id_producto
                                           join imagenes i on p.id_producto = i.id_producto
                                           where f.id_usuario = " . session()->get('id') . " order by f.fecha_adicion desc");
            
            $favoritos = array();
            
            foreach($searchFavoritos as $favorito) {
                $precio = Utl::formatPrice($favorito->precio);
                $updated_at = Utl::formatDate($favorito->updated_at);
                $fecha_adicion = Utl::formatDate($favorito->fecha_adicion);
                $fecha_vendido = Utl::formatDate($favorito->fecha_vendido);
                
                $formattedFavorites =
                    array(
                        'id_producto' => $favorito->id_producto,
                        'precio' => $precio,
                        'nombre' => $favorito->nombre,
                        'updated_at' => $updated_at,
                        'vendido' => $favorito->vendido,
                        'fecha_vendido' => $fecha_vendido,
                        'img0' => $favorito->img0,
                        'fecha_adicion' => $fecha_adicion,
                    );
                
                array_push($favoritos, $formattedFavorites);    
            }
            
            if(count($favoritos) >= 1 && $favoritos) {
                return view('favoritos', ['favoritos'=>$favoritos]);
            } else {
                return view('favoritos');
            }
        } else {
            return view('perfil-no-sesion');
        }
    }
    
    // Añadir producto a favoritos
    function addFavoriteProduct($id_producto) {
        
        $addFavoriteProduct = DB::insert('insert into favoritos(id_usuario, id_producto, fecha_adicion) values(' . session()->get('id') . ', ' . $id_producto . ', now())');
        
        if($addFavoriteProduct) {
            return true;
        } else {
            return false;
        }
    }
    
    // Quitar producto de favoritos
    function quitFavoriteProduct($id_producto) {
        
        $quitFavoriteProduct = DB::delete('delete from favoritos where id_usuario = ' . session()->get('id') . ' and id_producto = ' . $id_producto);
        
        if($quitFavoriteProduct) {
            return true;
        } else {
            return false;
        }
    }
    
    // Añadir / Quitar producto de favoritos (AJAX)
    function checkFavoriteProduct(Request $request) {
        $id_producto = $request->id_producto;
        
        $checkFavoriteProduct = DB::select('select * from favoritos where id_usuario = ' . session()->get('id') . ' and id_producto = ' . $id_producto);
        
        if(count($checkFavoriteProduct) >= 1) {
            
            $borrar = $this->quitFavoriteProduct($id_producto);
            
            if($borrar == true) {
                return "Eliminado de favoritos";
            } else {
                return "Error al eliminar de favoritos";
            }
            
        } else {
            
            $insertar = $this->addFavoriteProduct($id_producto);
            
            if($insertar == true) {
                return "Añadido a favoritos";
            } else {
                return "Error al añadir a favoritos";
            }
            
        }
    }
    
    // Quitar producto de favoritos
    function deleteFavoriteProduct(Request $request) {
        $id_producto = $request->id_producto;
        
        $checkFavoriteProduct = DB::select('select * from favoritos where id_usuario = ' . session()->get('id') . ' and id_producto = ' . $id_producto);
        
        if(count($checkFavoriteProduct) >= 1) {
            $borrar = $this->quitFavoriteProduct($id_producto);
            
            if($borrar == true) {
                $request->session()->flash('mensajeExito', 'Favorito eliminado');
            } else {
                $request->session()->flash('mensajeError', 'Error al eliminar el favorito');
            }
        }
        
        return back();
    }
}
