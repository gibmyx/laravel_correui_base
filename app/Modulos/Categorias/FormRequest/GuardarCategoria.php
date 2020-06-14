<?php

namespace App\Modulos\Categorias\FormRequest;

use App\Modulos\Categorias\Models\Categoria;
use App\Http\Services\Guardar;
use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Capsule\Manager as DB;

class GuardarCategoria extends Guardar
{
    public function __construct()
    {
        parent::__construct(new Categoria);
    }

    function create($params)
    {
        $params['condicion'] = 1;
        return DB::transaction(function () use ($params) {
            $model = $this->model;
            $object = $model::create($params);
            return $object;
        });
    }

    function update($params)
    {
        return DB::transaction(function () use ($params) {
            $model = $this->model;
            $object = $model::find($params['id']);
            $object->update($params);
            return $object;
        });
    }
}
