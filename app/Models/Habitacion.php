<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'tipo',
        'descripcion',
        'precio',
        'stock',
        'url_imagen',
        'disponible',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'disponible' => 'boolean',
    ];
}
