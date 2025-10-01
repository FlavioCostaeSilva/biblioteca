<?php

namespace App\Repositories;

use App\Models\Livro;

interface LivroRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(Livro $livro, array $data);
    public function delete(Livro $livro);
}
