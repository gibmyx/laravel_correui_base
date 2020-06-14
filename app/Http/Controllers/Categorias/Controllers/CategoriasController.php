<?php

namespace App\Http\Controllers\Categorias\Controllers;

use App\Modulos\Categorias\FormRequest\GuardarCategoria;
use App\Modulos\Categorias\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $value = array_filter($request->capture()->all());
        $categorias = Categoria::DeFiltro($value)->orderBy('id', 'desc')->paginate(5);
        $data = [
            'pagination' => [
                'total'         => $categorias->total(8),
                'current_page'  => $categorias->currentPage(),
                'per_page'      => $categorias->perPage(),
                'last_page'     => $categorias->lastPage(),
                'from'          => $categorias->firstItem(),
                'to'            => $categorias->lastItem(),
            ],
            'categorias' => $categorias,
        ];
        return response()->json($data, 201);
    }

}
