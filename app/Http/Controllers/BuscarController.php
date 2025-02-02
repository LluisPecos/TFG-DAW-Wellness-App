<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Utl;
use App\Classes\Busqueda;
use DateTime;
use Session;
use DB;

class BuscarController extends Controller
{
    function buscarProducto(Request $request, $num = null) {
        
        $this->validate($request, [
            'busqueda' => ['nullable'],
            'estado' => ['nullable', 'numeric'],
            'categoria' => ['nullable', 'numeric'],
            'minPrecio' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'maxPrecio' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'modificadoHace' => ['nullable', 'numeric', 'min:1', 'max:30']
        ]);
        
        $busqueda = $request->busqueda;
        $estado = $request->estado;
        $categoria = $request->categoria;
        $minPrecio = $request->minPrecio;
        $maxPrecio = $request->maxPrecio;
        $modificadoHace = $request->modificadoHace;
        
        $nuevaBusqueda = new Busqueda($busqueda, $estado, $categoria, $minPrecio, $maxPrecio, $modificadoHace); // Offset default null, in defaultFilters if empty take value 0
        $resultadosBusqueda = $nuevaBusqueda->getSearchResults();
        
        $categorias = DB::select("select * from categorias");
        $estados = DB::select("select * from estados");

        if(sizeof($resultadosBusqueda) >= 1 && !empty($resultadosBusqueda)) {
            // Devolver vista buscar
            return view("buscar", ['busqueda'=>$busqueda, 'productos'=>$resultadosBusqueda, 'estados'=>$estados, 'categorias'=>$categorias, 'request'=>$request]);
        }
        
        session()->flash("mensajeError", "No se ha encontrado ningún producto con la busqueda \"" . $busqueda . "\"");
        return view("buscar", ['busqueda'=>$busqueda, 'estados'=>$estados, 'categorias'=>$categorias, 'request'=>$request]);
    }
    
    function mostrarMasProductos(Request $request) {
        $this->validate($request, [
            'busqueda' => ['nullable'],
            'estado' => ['nullable', 'numeric'],
            'categoria' => ['nullable', 'numeric'],
            'minPrecio' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'maxPrecio' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'modificadoHace' => ['nullable', 'numeric', 'min:1', 'max:30'],
            'offset' => ['required', 'numeric']
        ]);
        
        $busqueda = $request->busqueda;
        $estado = $request->estado;
        $categoria = $request->categoria;
        $minPrecio = $request->minPrecio;
        $maxPrecio = $request->maxPrecio;
        $modificadoHace = $request->modificadoHace;
        $offset = $request->offset;
        
        $nuevaBusqueda = new Busqueda($busqueda, $estado, $categoria, $minPrecio, $maxPrecio, $modificadoHace, $offset);
        $resultadosBusqueda = $nuevaBusqueda->getSearchResults();
        
        if(sizeof($resultadosBusqueda) >= 1 && !empty($resultadosBusqueda)) {
            // Devolver vista mostrarProductos
            return view("include/buscar/searchProductCard", ['productos'=>$resultadosBusqueda]);
        }
        
        return false;
    }
    
    function filtrarProductos(Request $request) {
        $this->validate($request, [
            'busqueda' => ['nullable'],
            'estado' => ['nullable', 'numeric'],
            'categoria' => ['nullable', 'numeric'],
            'minPrecio' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'maxPrecio' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'modificadoHace' => ['nullable', 'numeric', 'min:1', 'max:30']
        ]);
        
        $busqueda = $request->busqueda;
        $estado = $request->estado;
        $categoria = $request->categoria;
        $minPrecio = $request->minPrecio;
        $maxPrecio = $request->maxPrecio;
        $modificadoHace = $request->modificadoHace;
        $offset = $request->offset;
        
        $nuevaBusqueda = new Busqueda($busqueda, $estado, $categoria, $minPrecio, $maxPrecio, $modificadoHace);
        $resultadosBusqueda = $nuevaBusqueda->getSearchResults();
        
        if(sizeof($resultadosBusqueda) >= 1 && !empty($resultadosBusqueda)) {
            // Devolver vista mostrarProductos
            return view("include/buscar/searchProductCard", ['productos'=>$resultadosBusqueda]);
        }
        
        return false;
    }
    
    function searchNoResults() {
        return view('include/buscar/searchNoResults');
    }
}
