<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $casts = [
        'fecha_ingreso' => 'datetime',
        'estado' => 'boolean',
        'ediciones_pasdas' => 'array',
    ];
    
    protected $table = 'libros';
}
