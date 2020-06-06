<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Guardar
{
    protected $request;
    protected $model;
    protected $modelName;

    public function __construct(Model $model)
    {
        $this->setModel(new $model);
        $this->request = Request::capture()->all();
    }

    public function save($params = [])
    {
        $params = empty($params) ? $this->request : $params;
        if(isset($params['id']) && !empty($params['id'])){
            return $this->update($params);
        }

        return $this->create($params);
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        $this->modelName = get_class($model);
    }

    abstract function create($params);

    abstract function update($params);
}
