<?php

namespace App\Modulos\Articulos\Models;

use App\Modulos\Articulos\Services\ArticulosQueryFilters;
use App\Modulos\Categorias\Models\Categoria;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulos';
    protected $fillable = [
        'categoria_id',
        'codigo',
        'nombre',
        'precio_venta',
        'stock',
        'descripcion',
        'condicion',
    ];
//    protected $casts = [
//        'fecha_limite' => 'datetime'
//    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function scopeDeFiltro($query, $campo)
    {
        $queryFilter = new ArticulosQueryFilters();
        return $queryFilter->apply($query, $campo);
    }
}
