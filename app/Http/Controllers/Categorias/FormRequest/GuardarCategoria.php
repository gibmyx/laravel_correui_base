<?php

namespace App\Http\Controllers\Categorias\FormRequest;

use App\Categoria;
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
