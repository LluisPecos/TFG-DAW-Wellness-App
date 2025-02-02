<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Utl;
use Illuminate\Support\Facades\File;

use DB;

class PerfilController extends Controller
{
    function perfil() {
        if(session()->has('id')) {
            if(!empty(session()->get('id'))) {
                $perfil = DB::select("select nombre, apellidos, img_perfil, fecha_nacimiento, genero, email, telefono from usuarios where id_usuario = " . session()->get('id'));
                return view("perfil", ['perfil'=>$perfil]);
            }
        } else {
            return view("perfil-no-sesion");
        }
    }
    
    function perfilNoSesion() {
        return view("perfil-no-sesion");
    }
    
    function guardarImgPerfil(Request $request) {
        
        if(isset($request->img_perfil) && $request->hasFile('img_perfil') && $request->file('img_perfil')->isValid()) {
            
            $this->validate($request, [
                'img_perfil' => ['image', 'mimes:jpeg,jpg,png', 'required', 'max:1024'],
            ]);
            
            $img_perfil = DB::select('select img_perfil from usuarios where id_usuario = ' . session()->get('id'));
            
            if($img_perfil && count($img_perfil) == 1) {
                $imgUrl;
                
                foreach($img_perfil as $img) {
                    $imgUrl = $img->img_perfil;
                }
                
                if($imgUrl != "imgs/perfil/default.svg") {
                    $files = array($imgUrl);
                    File::delete($files);
                }
                
                $img = $request->file('img_perfil');
                $date = date("Y-m-d", time());
                $path = public_path() . "/imgs/perfil/usuarios/";
                $fileName = session()->get('id') . "_" . $date . "." . $img->getClientOriginalExtension();
                
                if($img->move($path, $fileName)) {
                    
                    $dbPath = "imgs/perfil/usuarios/" . $fileName;
                    
                    $updateImgPerfil = DB::update("update usuarios set img_perfil = '" . $dbPath . "' where id_usuario = " . $request->session()->get('id'));
                    
                    session()->flash('mensajeExito', 'Imágen de perfil actualizada');
                    
                } else {
                    session()->flash('mensajeError', 'Error al guardar la imágen de perfil');
                }
            
            } else {
                session()->flash('mensajeError', 'Error al buscar tu imágen de perfil actual');
            }
            
        } else {
            session()->flash('mensajeError', 'No se ha encontrado ninguna imágen');
        }
        return back();
    }
    
    function guardarDatosPerfil(Request $request) {
            
        $this->validate($request, [
            'nombre' => ['required', 'string', 'regex:/^.+$/','max:255'],
            'apellidos' => ['required', 'string', 'regex:/^.+$/', 'max:255'],
            'email' => ['required', 'string', 'regex:/^.+@.+\..+$/', 'max:255'],
            'telefono' => ['nullable', 'numeric', 'regex:/^\d{9}$/'],
            'fechaNacimiento' => ['nullable', 'regex:/^\d{4}-\d{2}-\d{2}$/'],
            'genero' => ['nullable', 'string', 'regex:/^(M|F)$/']
        ]);

        $nombre = $request->nombre;
        $apellidos = $request->apellidos;
        $email = $request->email;
        $telefono = $request->telefono;
        $fechaNacimiento = $request->fechaNacimiento;
        $genero = $request->genero;

        $updateUsuario;

        if(empty($telefono)) {
            $telefono = "null";
        }

        if(empty($fechaNacimiento)) {
            $fechaNacimiento = "null";
        } else {
            $fechaNacimiento = "'" . $fechaNacimiento . "'";
        }

        if(empty($genero)) {
            $genero = "null";
        } else {
            $genero = "'" . $genero . "'";
        }

        $searchEmail = DB::select("select email from usuarios where email = '" . $email . "' and id_usuario != " . $request->session()->get('id'));

        if($searchEmail && count($searchEmail) >= 1) {
            $searchEmail = DB::select("select email from usuarios where id_usuario = '" . $request->session()->get('id') . "'");
            $email = $searchEmail[0]->email;
            $request->session()->flash('mensajeErrorPerfilDatos', 'El email al que has intentado actualizar ya se encuentra en uso');
        }

        $updateUsuario = DB::update("update usuarios set nombre = '" . $nombre . "', apellidos = '" . $apellidos . "', email = '" . $email . "', telefono = " . $telefono . ", genero = " . $genero . ", fecha_nacimiento = " . $fechaNacimiento . ", updated_at = now() where id_usuario = " . $request->session()->get('id'));

        if ($updateUsuario) {
            $request->session()->flash('mensajeExitoPerfilDatos', 'Perfil actualizado');
        } else {
            $request->session()->flash('mensajeErrorPerfilDatos', 'Ha surgido un error inesperado al actualizar los datos del perfil');
        }

        return back();
    }
}
