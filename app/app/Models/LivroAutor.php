<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroAutor extends Model
{
    protected $table = 'Livro_Autor';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    protected $fillable = ['Livro_Codl', 'Autor_CodAu'];
}
