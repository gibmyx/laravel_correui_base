<?php

namespace App\Modulos\Articulos\FormRequest;

use App\Modulos\Articulos\Models\Articulo;
use App\Http\Services\Guardar;
use Illuminate\Support\Facades\DB;

class GuardarArticulos extends Guardar
{
    public function __construct()
    {
        parent::__construct(new Articulo);
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
