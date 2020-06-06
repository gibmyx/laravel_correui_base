<?php

namespace App\Http\Controllers\Herramientas\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HerramientasController extends Controller
{

    public function prueba_peticion(Request $request)
    {
        $response = [
            'mensaje' => 'Esta funcionando Fino',
        ];
        return response()->json($response, 200);
    }

}
