<?php

namespace App\Repositories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Collection;

class LivroRepository implements LivroRepositoryInterface
{
    public function all(): Collection
    {
        return Livro::all();
    }

    public function find($id)
    {
        return Livro::with(['autores', 'assuntos'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Livro::create($data);
    }

    public function update(Livro $livro, array $data)
    {
        $livro->update($data);
        return $livro;
    }

    public function delete(Livro $livro)
    {
        $livro->delete();
    }
}
