<?php

namespace App\Http\Controllers\Categorias\Controllers;

use App\Http\Controllers\Categorias\FormRequest\GuardarCategoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Categoria;

class CategoriasController extends Controller
{

    public function ajax_guardar(Request $request)
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

    public function ajax_update_state(Request $request)
    {
        $error = '';
        $params = [
          'id' => $request->id,
          'condicion' => $request->condicion,
        ];
        try {
            (new GuardarCategoria())->save($params);
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
