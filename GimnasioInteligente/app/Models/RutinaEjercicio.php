<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinaEjercicio extends Model
{
    use HasFactory;

    protected $fillable = ['idRutina', 'idEjercicio'];
}
