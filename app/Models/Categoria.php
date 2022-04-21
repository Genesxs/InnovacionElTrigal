<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable=['id','descripcion'];

    public function ideas(){
        return $this->hasMany(Ideas::class);
    }
}
