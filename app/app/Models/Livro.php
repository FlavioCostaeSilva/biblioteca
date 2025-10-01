<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Livro extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Livro';
    protected $primaryKey = 'Codl';
    public $timestamps = false;
    protected $fillable = ['Codl', 'Titulo', 'Editora', 'AnoPublicacao', 'Preco'];

    public function autores()
    {
        return $this->belongsToMany(Livro::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_codAs');
    }
}
