<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

abstract class Guardar
{
    protected $request;

    public function __construct()
    {
        $this->request = Request::capture();
    }

    public function save($params = [])
    {
        if(isset($params['id']) && !empty($params['id'])){
            return $this->update($params);
        }

        return $this->create($params);
    }

    abstract function create($params);

    abstract function update($params);
}
