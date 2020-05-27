<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function prueba_peticion()
    {
        $response = [
            'mensaje' => 'mensaje de prueba',
        ];
        return response()->json($response, 200);
    }


//    public function guardar_old()
//    {
//        $error = '';
//
//        try {
//            (new GuardarFormulario())->guardar();
//        } catch (\Exception $e) {
//            $error .= $e->getMessage();
//        }
//
//        $response = [
//            'message' => strlen($error) ? $error : '<b>Éxito!</b><br> Se han guardado sus cambios.',
//            'name' => strlen($error) ? '' : 'formularios',
//            'code' => strlen($error) ? 401 : 201,
//        ];
//
//        return response($response, $response['code']);
//    }
}
