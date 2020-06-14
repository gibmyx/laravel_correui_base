<?php

namespace App\Http\Controllers\Categorias\Models;

use App\Http\Controllers\Articulos\Models\Articulo;
use App\Http\Controllers\Categorias\Services\CategoriaQueryFilters;
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
