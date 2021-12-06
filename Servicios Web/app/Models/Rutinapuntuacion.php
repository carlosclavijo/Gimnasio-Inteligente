<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutinapuntuacion extends Model
{
    use HasFactory;
    protected $fillable = ['idUsuario', 'idEjercicio', 'puntuacion'];
}
