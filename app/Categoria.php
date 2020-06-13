<?php

namespace App;

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

    public function scopeDeFiltro($query, $campo)
    {
        $queryFilter = new CategoriaQueryFilters();
        return $queryFilter->apply($query, $campo);
    }
}
