<?php

namespace App\Modulos\Categorias\Models;

use App\Modulos\Articulos\Models\Articulo;
use App\Modulos\Categorias\Services\CategoriaQueryFilters;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = [
        'nombre',
        'descripcion',
        'condicion',
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'categoria_id');
    }

    public function scopeDeFiltro($query, $campo)
    {
        $queryFilter = new CategoriaQueryFilters();
        return $queryFilter->apply($query, $campo);
    }
}
