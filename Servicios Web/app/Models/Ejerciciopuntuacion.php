<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejerciciopuntuacion extends Model
{
    use HasFactory;
    protected $fillable = ['idUsuario', 'idEjercicio', 'puntuacion'];
}
