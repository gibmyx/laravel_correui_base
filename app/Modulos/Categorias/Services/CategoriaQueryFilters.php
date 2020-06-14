<?php

namespace App\Modulos\Categorias\Services;

use App\Providers\QueryFilters;

class CategoriaQueryFilters extends  QueryFilters
{

    public function nombre($value)
    {
//        $value = $this->get_value($value);
        $this->builder->where('categorias.nombre', 'like', "%{$value}%");
    }
    public function descripcion($value)
    {
//        $value = $this->get_value($value);
        $this->builder->where('categorias.descripcion', 'like', "%{$value}%");
    }

}
