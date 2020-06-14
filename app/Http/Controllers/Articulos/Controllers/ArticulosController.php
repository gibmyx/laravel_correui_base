<?php

namespace App\Http\Controllers\Articulos\Controllers;

use App\Http\Controllers\Articulos\FormRequest\GuardarArticulos;
use App\Http\Controllers\Articulos\Models\Articulo;
use App\Http\Controllers\Categorias\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticulosController extends Controller
{

    public function ajax_guardar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $error = '';

        try {
            (new GuardarArticulos())->save();
        } catch (\Exception $e) {
            $error .= $e->getMessage();
        }
        $response = [
            'message' => strlen($error) ? $error : 'Se han guardado sus cambios.',
            'code' => strlen($error) ? 401 : 201,
        ];
        return response()->json($response, $response['code']);
    }

    public function ajax_get_catalogos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $categorias = Categoria::where('condicion', 1)->select('id', 'nombre')->orderBy('id', 'desc')->get();

        $response = [
            'categorias' => $categorias,
        ];
        return response()->json($response, 201);
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
            (new GuardarArticulos())->save($params);
        } catch (\Exception $e) {
            $error .= $e->getMessage();
        }
        $response = [
            'message' => strlen($error) ? $error : 'Se han guardado sus cambios.',
            'code' => strlen($error) ? 401 : 201,
        ];
        return response()->json($response, $response['code']);
    }

    public function ajax_listar_articulos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $value = array_filter($request->capture()->all());
        $Articulos = Articulo::DeFiltro($value)->paginate(5);
        $data = [
            'pagination' => [
                'total'         => $Articulos->total(8),
                'current_page'  => $Articulos->currentPage(),
                'per_page'      => $Articulos->perPage(),
                'last_page'     => $Articulos->lastPage(),
                'from'          => $Articulos->firstItem(),
                'to'            => $Articulos->lastItem(),
            ],
            'articulos' => $Articulos->map(function (Articulo $Articulo){
                return collect(array_merge($Articulo->toArray(), ['categoria' =>  !isEmpty($Articulo->categoria) ? $Articulo->categoria->nombre : '']));
            }),
        ];
        return response()->json($data, 201);
    }

}
