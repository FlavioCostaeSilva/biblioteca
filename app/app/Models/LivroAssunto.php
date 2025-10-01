<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    protected $table = 'Livro_Assunto';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = ['Livro_Codl', 'Assunto_codAs'];
}
