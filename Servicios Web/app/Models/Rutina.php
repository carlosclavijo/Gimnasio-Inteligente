<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'visibilidad', 'descripcion', 'puntuacion', 'idCreador'];
}
