<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'ediciones_pasadas' => 'array',
        'fecha_ingreso' => 'datetime:Y-m-d'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'idioma',
        'precio',
        'estado',
        'fecha_ingreso'
    ];
}
