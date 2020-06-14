<?php

namespace App\Http\Controllers\Articulos\Services;

use App\Providers\QueryFilters;

class ArticulosQueryFilters extends  QueryFilters
{

    public function nombre($value)
    {
//        $value = $this->get_value($value);
        $this->builder->where('Articulos.nombre', 'like', "%{$value}%");
    }
    public function descripcion($value)
    {
//        $value = $this->get_value($value);
        $this->builder->where('Articulos.descripcion', 'like', "%{$value}%");
    }

}
