<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    use HasFactory;

    public $table = "estudiantes";
    protected $fillable = [
        'nombre',
        'apellido',
        'foto',
        'id'
    ];
    
    public function cursos(){
        return $this->belongsToMany(curso::class,"curso_estudiante");
    }
}
