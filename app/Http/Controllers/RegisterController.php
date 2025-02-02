<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller {
    
    function validarRegistroAjax(Request $request) {
        // POST method
        if(isset($request->email)) {
            
            $email = $request->input('email');
            
            $buscar_email = DB::select("select email from usuarios where email = '" . $email . "';");
            
            if (count($buscar_email) >= 1) {
                echo "Dirección de email duplicada";
            } else {
                echo "registroExito";
            }
        }
    }
    
    function validarRegistro(Request $request) {
        
        // POST method
        if(isset($request->nombre) && isset($request->apellidos) && isset($request->email) && isset($request->contraseña) && isset($request->contraseñaRepetida)) {
            
            $this->validate($request, [
                'nombre' => ['required', 'string', 'regex:/^.+$/','max:255'],
                'apellidos' => ['required', 'string', 'regex:/^.+$/', 'max:255'],
                'email' => ['required', 'string', 'regex:/^.+@.+\..+$/', 'max:255'],
                'contraseña' => ['required', 'min:8', 'max:25', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,25}$/'],
                'contraseñaRepetida' => ['required', 'min:8', 'max:25', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,25}$/'],
            ]);
            
            $nombre = $request->input('nombre');
            $apellidos = $request->input('apellidos');
            $email = $request->input('email');
            $contraseña = $request->input('contraseña');
            $contraseñaRepetida = $request->input('contraseñaRepetida');
            
            $buscar_email = DB::select("select email from usuarios where email = '" . $email . "';");
            
            if (count($buscar_email) >= 1) {
                $request->session()->flash('mensajeError', 'Dirección de email duplicada');
                return back();
                
            } else {
                
                if ($contraseña == $contraseñaRepetida) {
                    
                    $ctrs_cifrada = bcrypt($contraseña);
                    
                    $insertar_usuario = DB::insert("insert into usuarios(nombre, apellidos, email, contraseña, created_at) values ('" . $nombre . "', '" . $apellidos . "', '" . $email . "', '" . $ctrs_cifrada . "', now());");
                    
                    if ($insertar_usuario) {
                        $request->session()->flash('mensajeExito', 'Te has registrado!');
                        return back();
                    } else {
                        $request->session()->flash('mensajeError', 'Ha surgido un error inesperado al registrarse');
                        return back();
                    }
                    
                } else {
                    $request->session()->flash('mensajeError', 'Las contraseñas no coinciden');
                    return back();
                }
            }
        }
    }
}