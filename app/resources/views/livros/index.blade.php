@extends('layouts.app')

@section('title', 'Livros')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Livros</h1>
        <a href="{{ route('livros.create') }}" class="btn btn-primary">Adicionar Novo Livro</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($livros->isEmpty())
        <p>Nenhum livro cadastrado.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Editora</th>
                <th>Ano de Publicação</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($livros as $livro)
                <tr>
                    <td>{{ $livro->Codl }}</td>
                    <td>{{ $livro->Titulo }}</td>
                    <td>{{ $livro->Editora }}</td>
                    <td>{{ $livro->AnoPublicacao }}</td>
                    <td>{{ $livro->Preco }}</td>
                    <td>
                        <a href="{{ route('livros.show', $livro) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('livros.edit', $livro) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('livros.destroy', $livro) }}" method="POST" style="display:inline;">
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
