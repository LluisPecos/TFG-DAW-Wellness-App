<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController extends Controller
{
    function validarLoginAjax(Request $request) {
        
        // POST method
        if(isset($request->email) && ($request->contraseña)) {
            
            $email = $request->input('email');
            $contraseña = $request->input('contraseña');

            $buscar_usuario = DB::select("select * from usuarios where email = '" . $email . "';");
            
            if(count($buscar_usuario) >= 1) {
                
                foreach($buscar_usuario as $usuario) {
                    
                    if(Hash::check($contraseña, $usuario->contraseña)) {
                        // Submit form
                        echo "loginExito";
                        
                    } else {
                        // Contraseña incorrecta
                        echo "La contraseña introducida es incorrecta";
                    }
                }
                
            } else {
                // Dirección de email no registrada
                echo "Dirección de email no registrada";
            }
        }
    }
    
    function validarLogin(Request $request) {
        
        $this->validate($request, [
            'email' => ['required', 'regex:/^.+@.+\..+$/'],
            'contraseña' => ['required', 'min:8', 'max:25', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,25}$/'],
        ]);

        $email = $request->input('email');
        $contraseña = $request->input('contraseña');

        $buscar_usuario = DB::select("select * from usuarios where email = '" . $email . "';");
        //DB::table('usuarios')->where(['email'=>$email, 'contraseña'=>$contraseña])->get();

        if(count($buscar_usuario) >= 1) {

            foreach($buscar_usuario as $usuario) {

                if(Hash::check($contraseña, $usuario->contraseña)) {

                    $id = $usuario->id_usuario;
                    $nombre = $usuario->nombre;
                    $apellidos = $usuario->apellidos;
                    $email = $usuario->email;
                    $rol = $usuario->rol;

                    // $request->session()->put('id', $id);
                    // session()->put('nombre', $nombre);
                    // session()->put('apellidos', $apellidos);
                    // session()->put('email', $email);
                    // session()->put('rol', $rol);

                    session(['id' => $id]);
                    session(['nombre' => $nombre]);
                    session(['apellidos' => $apellidos]);
                    session(['email' => $email]);
                    session(['rol' => $rol]);

                    // This dumps the title string as expected...
                    //dd(session('id'));
                    //dd(session('nombre'));
                    //dd(session('apellidos'));
                    //dd(session('email'));
                    //dd(session('rol'));

                    //Saving the session...
                    Session::save();

                    // $request->session()->reflash(['mensajeExito', 'Has iniciado sesión']);
                    // $request->session()->keep(['mensajeExito', 'Has iniciado sesión']);
                    $request->session()->flash('mensajeExito', 'Has iniciado sesión');
                    return back();

                } else {
                    // Contraseña incorrecta

                    //Session::flash('mensajeError', "Contraseña incorrecta");
                    $request->session()->flash('mensajeError', 'Contraseña incorrecta');
                    return back();
                }
            }

        } else {
            // Dirección de email no registrada
            //Session::flash('mensajeError', "Contraseña Dirección de email no registrada");
            $request->session()->flash('mensajeError', 'Dirección de email no registrada');
            return back();
        }
    }
    
    function cerrarSesion() {
        session()->flush();
        //session()->flash('mensajeExito', 'Has cerrado sesión');
        return redirect("/");
    }
}