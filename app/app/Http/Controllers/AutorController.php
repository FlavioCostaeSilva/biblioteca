<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::all();
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nome' => 'required|string|max:40',
        ]);

        Autor::create($validated);

        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso!');
    }

    public function show(Autor $autor)
    {
        return view('autores.show', compact('autor'));
    }

    public function edit(Autor $autor)
    {
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, Autor $autor)
    {
        $validated = $request->validate([
            'Nome' => 'required|string|max:40',
        ]);

        $autor->update($validated);

        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();
        return redirect()->route('autores.index')->with('success', 'Autor excluído com sucesso!');
    }
}
