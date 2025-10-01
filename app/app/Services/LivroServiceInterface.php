<?php

namespace App\Services;

use App\Models\Livro;

interface LivroServiceInterface
{
    public function getAllLivros();
    public function getLivroById($id);
    public function createLivro(array $data);
    public function updateLivro($id, array $data);
    public function deleteLivro($id);
}
