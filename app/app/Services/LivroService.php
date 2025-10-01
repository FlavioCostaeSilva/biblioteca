<?php

namespace App\Services;

use App\Repositories\LivroRepositoryInterface;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Support\Facades\Validator;

class LivroService implements LivroServiceInterface
{
    protected LivroRepositoryInterface $repository;

    public function __construct(LivroRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllLivros()
    {
        return $this->repository->all();
    }

    public function getLivroById($id)
    {
        return $this->repository->find($id);
    }

    public function createLivro(array $data)
    {
        $validated = $this->validateData($data);

        $livro = $this->repository->create($validated);

        $this->attachRelations($livro, $validated);

        return $livro;
    }

    public function updateLivro($id, array $data)
    {
        $livro = $this->getLivroById($id);
        $validated = $this->validateData($data);

        $this->repository->update($livro, $validated);

        $this->syncRelations($livro, $validated);

        return $livro;
    }

    public function deleteLivro($id)
    {
        $livro = $this->getLivroById($id);
        $this->repository->delete($livro);
    }

    private function validateData(array $data): array
    {
        $anoAtual = now()->year;

        $validator = Validator::make($data, [
            'Titulo' => 'required|string|max:40',
            'Editora' => 'required|string|max:40',
            'AnoPublicacao' => "required|numeric|digits:4|min:1000|max:{$anoAtual}",
            'Preco' => 'required|numeric|min:0',
            'autores' => 'array',
            'assuntos' => 'array',
        ]);

        $validated = $validator->validate();

        $validated['Preco'] = (int) round($validated['Preco'] * 100);

        return $validated;
    }

    private function attachRelations(Livro $livro, array $data)
    {
        if (isset($data['autores'])) {
            $livro->autores()->attach($data['autores']);
        }
        if (isset($data['assuntos'])) {
            $livro->assuntos()->attach($data['assuntos']);
        }
    }

    private function syncRelations(Livro $livro, array $data)
    {
        $livro->autores()->sync($data['autores'] ?? []);
        $livro->assuntos()->sync($data['assuntos'] ?? []);
    }

    public function getAutoresAndAssuntos(): array
    {
        return [
            'autores' => Autor::all(),
            'assuntos' => Assunto::all(),
        ];
    }
}
