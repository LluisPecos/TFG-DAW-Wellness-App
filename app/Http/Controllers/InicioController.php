<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function inicio() {
        return view("inicio");
    }
}
