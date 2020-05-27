<?php

namespace App\Http\Controllers\Api;

use App\CajadeCompra;
use App\CentroContable;
use App\CentroContableOperativo;
use App\Colaborador;
use App\CuentaCPreFiltrada;
use App\FlexioModel\CatalogoTipoOrdenTrabajo;
use App\FlexioModel\CuentaContable;
use App\FlexioModel\OrdenCompra;
use App\FlexioModel\ProveedorContacto;
use App\FlexioModel\SubcontratoCatalogo;
use App\Formulario;
use App\ItemActivoFijo;
use App\ItemSerializado;
use App\Lista;
use App\Catalogo;
use App\Pages\Formularios\Guardar\GuardarFormulario;
use App\Pages\Formularios\Jqgrid\FormularioJqgrid;
use App\Pages\ItemActivoFijo\Filter\ItemActivoFijoFilters;
use App\Proveedor;
use App\ProyectoCC;
use App\Session\SolicitudSession;
use App\TabladeDistribucion;
use App\Usuarios;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormularioController extends Controller
{

    public function guardar()
    {
        $response = [
            'mensaje' => 'mensaje de prueba',
        ];
        return response()->json($response, 200);
    }


    public function guardar_old()
    {
        $error = '';

        try {
            (new GuardarFormulario())->guardar();
        } catch (\Exception $e) {
            $error .= $e->getMessage();
        }

        $response = [
            'message' => strlen($error) ? $error : '<b>Éxito!</b><br> Se han guardado sus cambios.',
            'name' => strlen($error) ? '' : 'formularios',
            'code' => strlen($error) ? 401 : 201,
        ];

        return response($response, $response['code']);
    }

}
