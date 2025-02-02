<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Utl;
use DB;

class AdministradorController extends Controller
{
    function administrador() {
        if(session()->has('id') && session()->has('rol')) {
            if(!empty(session()->get('rol')) && session()->get('rol') == "adm") {
                return view("administrador");
            }
        }
        
        return redirect('/');
    }
    
    function buscarUsuario(Request $request) {
        
        $userSearch = $request->userSearch;
        $patron = "/(^.+@.+\..+$)|(^[0-9]{1,}$)/";
        
        if(preg_match($patron, $userSearch)) {
            $usuario = DB::select("select id_usuario, nombre, apellidos, email, fecha_nacimiento, genero, telefono, rol, created_at, updated_at from usuarios where id_usuario = '" . $userSearch . "' or email = '" . $userSearch . "'");
            
            if(count($usuario) >= 1) {
                
                $formattedUser = [];
                
                foreach($usuario as $datos) {
                    $id_usuario = $datos->id_usuario;
                    $fecha_nacimiento = Utl::formatDate($datos->fecha_nacimiento);
                    $created_at = Utl::formatDate($datos->created_at);
                    $updated_at = Utl::formatDate($datos->updated_at);
                    
                    $formattedData = [
                        'id_usuario' => $id_usuario,
                        'nombre' => $datos->nombre,
                        'apellidos' => $datos->apellidos,
                        'email' => $datos->email,
                        'fecha_nacimiento' => $fecha_nacimiento,
                        'genero' => $datos->genero,
                        'telefono' => $datos->telefono,
                        'rol' => $datos->rol,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ];
                    
                    array_push($formattedUser, $formattedData);
                }
                
                $productos = DB::select("select * from productos p
                                         join estados e on p.id_estado = e.id_estado
                                         join categorias c on p.id_categoria = c.id_categoria
                                         where id_usuario = " . $id_usuario);
                
                $formattedProducts = [];
                
                foreach($productos as $producto) {
                    $precio = Utl::formatPrice($producto->precio);
                    $fecha_vendido = Utl::formatDate($producto->fecha_vendido);
                    $created_at = Utl::formatDate($producto->created_at);
                    $updated_at = Utl::formatDate($producto->updated_at);
                    
                    $formattedProduct = [
                        "id_producto" => $producto->id_producto,
                        "precio" => $precio,
                        "nombre" => $producto->nombre,
                        "categoria" => $producto->categoria,
                        "estado" => $producto->estado,
                        "descripcion" => $producto->descripcion,
                        "visitas" => $producto->visitas,
                        "vendido" => $producto->vendido,
                        "fecha_vendido" => $fecha_vendido,
                        "created_at" => $created_at,
                        "updated_at" => $updated_at,
                    ];
                    
                    array_push($formattedProducts, $formattedProduct);
                }
                
                return view("include/administrador/search-user-table", ['usuario'=>$formattedUser, 'productos'=>$formattedProducts]);
            }
            
            return "noUser";
        }
        else
        {
            return "invalidSearch";
        }
    }
}
