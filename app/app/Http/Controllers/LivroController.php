<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::all();
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.create', compact('autores', 'assuntos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Titulo' => 'required|string|max:40',
            'Editora' => 'required|string|max:40',
            'AnoPublicacao' => 'required|string|size:4',
            'Preco' => 'required|integer',
            'autores' => 'array',
            'assuntos' => 'array',
        ]);

        $livro = Livro::create($validated);

        if (isset($validated['autores'])) {
            $livro->autores()->attach($validated['autores']);
        }

        if (isset($validated['assuntos'])) {
            $livro->assuntos()->attach($validated['assuntos']);
        }

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro criado com sucesso!');
    }

    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    public function update(Request $request, Livro $livro)
    {
        $validated = $request->validate([
            'Titulo' => 'required|string|max:40',
            'Editora' => 'required|string|max:40',
            'AnoPublicacao' => 'required|string|size:4',
            'Preco' => 'required|integer',
            'autores' => 'array',
            'assuntos' => 'array',
        ]);

        $livro->update($validated);

        $livro->autores()->sync($validated['autores'] ?? []);
        $livro->assuntos()->sync($validated['assuntos'] ?? []);

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}
