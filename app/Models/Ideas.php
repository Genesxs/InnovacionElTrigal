<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    use HasFactory;

    protected $fillable=['nombre','descripcion','categoria_id','proceso_impacto_id','estado','observacion'];

    //relacion uno a muchos inversa
    public function categorias(){
        return $this->belongsTo(Categoria::class);
    }
    
    public function procesosImpacto(){
        return $this->belongsTo(ProcesosImpacto::class);
    }

    //Relación muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
