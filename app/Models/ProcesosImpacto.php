<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesosImpacto extends Model
{
    use HasFactory;

    protected $fillable=['id','descripcion'];

    //Relación uno a muchos
    public function ideas(){
        return $this->hasMany(Ideas::class);
    }
}
