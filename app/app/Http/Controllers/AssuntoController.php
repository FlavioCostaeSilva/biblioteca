<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function index()
    {
        $assuntos = Assunto::all();
        return view('assuntos.index', compact('assuntos'));
    }

    public function create()
    {
        return view('assuntos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Descricao' => 'required|string|max:20',
        ]);

        Assunto::create($validated);

        return redirect()->route('assuntos.index')->with('success', 'Assunto criado com sucesso!');
    }

    public function show(Assunto $assunto)
    {
        return view('assuntos.show', compact('assunto'));
    }

    public function edit(Assunto $assunto)
    {
        return view('assuntos.edit', compact('assunto'));
    }

    public function update(Request $request, Assunto $assunto)
    {
        $validated = $request->validate([
            'Descricao' => 'required|string|max:20',
        ]);

        $assunto->update($validated);

        return redirect()->route('assuntos.index')->with('success', 'Assunto atualizado com sucesso!');
    }

    public function destroy(Assunto $assunto)
    {
        $assunto->delete();
        return redirect()->route('assuntos.index')->with('success', 'Assunto excluído com sucesso!');
    }
}
