<?php

namespace App\Http\Controllers;

use App\Services\LivroServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    protected LivroServiceInterface $service;

    public function __construct(LivroServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        $livros = $this->service->getAllLivros();
        return view('livros.index', compact('livros'));
    }

    public function create(): Factory|View|Application
    {
        $data = $this->service->getAutoresAndAssuntos();
        return view('livros.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->service->createLivro($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    public function show($id): Factory|View|Application
    {
        $livro = $this->service->getLivroById($id);
        return view('livros.show', compact('livro'));
    }

    public function edit($id): Factory|View|Application
    {
        $livro = $this->service->getLivroById($id);
        $data = $this->service->getAutoresAndAssuntos();
        return view('livros.edit', array_merge(compact('livro'), $data));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->service->updateLivro($id, $request->all());
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id): RedirectResponse
    {
        $this->service->deleteLivro($id);
        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}
