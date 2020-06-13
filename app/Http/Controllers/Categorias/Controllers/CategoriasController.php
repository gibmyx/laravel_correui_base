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
        if (!$request->ajax()) return redirect('/');

        $error = '';

        try {
            (new GuardarCategoria())->save();
        } catch (\Exception $e) {
            $error .= $e->getMessage();
        }
        $response = [
            'message' => strlen($error) ? $error : 'Se han guardado sus cambios.',
            'code' => strlen($error) ? 401 : 201,
        ];
        return response()->json($response, $response['code']);
    }

    public function ajax_update_state(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $value = $request->capture()->all();

        $error = '';
        $params = [
          'id' => $value['id'],
          'condicion' => $value['condicion'],
        ];
        try {
            (new GuardarCategoria())->save($params);
        } catch (\Exception $e) {
            $error .= $e->getMessage();
        }
        $response = [
            'message' => strlen($error) ? $error : 'Se han guardado sus cambios.',
            'code' => strlen($error) ? 401 : 201,
        ];
        return response()->json($response, $response['code']);
    }

    public function ajax_listar_categoria(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

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
