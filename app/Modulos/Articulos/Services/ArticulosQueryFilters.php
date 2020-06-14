<?php

namespace App\Modulos\Articulos\Services;

use App\Providers\QueryFilters;

class ArticulosQueryFilters extends  QueryFilters
{

    public function nombre($value)
    {
//        $value = $this->get_value($value);
        $this->builder->where('articulos.nombre', 'like', "%{$value}%");
    }
    public function descripcion($value)
    {
//        $value = $this->get_value($value);
        $this->builder->where('articulos.descripcion', 'like', "%{$value}%");
    }

}
