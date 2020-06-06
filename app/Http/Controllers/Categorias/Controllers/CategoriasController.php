<?php

namespace App\Http\Controllers\Herramientas\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Categoria;

class CategoriasController extends Controller
{

    public function ajax_guradar(Request $request)
    {
        $error = '';

        try {
            (new GuardarCategoria())->save();
        } catch (\Exception $e) {
            $error .= $e->getMessage();
        }
        $response = [
            'message' => strlen($error) ? $error : '<b>Éxito!</b><br> Se han guardado sus cambios.',
            'code' => strlen($error) ? 401 : 201,
        ];
        return response()->json($response, $response['code']);
    }

    public function ajax_listar_categoria()
    {
        $error = '';
        try {
            $categorias = Categoria::all();
        } catch (\Exception $e) {
            $error .= $e->getMessage();
        }
        $response = [
            'code' => strlen($error) ? 401 : 201,
            'data' => strlen($error) ? collect([]) : $categorias,
        ];
        return response()->json($response, $response['code']);
    }

}
