@extends('layouts.app')

@section('title', 'Autores')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Autores</h1>
        <a href="{{ route('autores.create') }}" class="btn btn-primary">Adicionar Novo Autor</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($autores->isEmpty())
        <p>Nenhum autor cadastrado.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($autores as $autor)
                <tr>
                    <td>{{ $autor->CodAu }}</td>
                    <td>{{ $autor->Nome }}</td>
                    <td>
                        <a href="{{ route('autores.show', $autor) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('autores.edit', $autor) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('autores.destroy', $autor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
