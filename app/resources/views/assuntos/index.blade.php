@extends('layouts.app')

@section('title', 'Assuntos')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Assuntos</h1>
        <a href="{{ route('assuntos.create') }}" class="btn btn-primary">Adicionar Novo Assunto</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($assuntos->isEmpty())
        <p>Nenhum assunto cadastrado.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($assuntos as $assunto)
                <tr>
                    <td>{{ $assunto->codAs }}</td>
                    <td>{{ $assunto->Descricao }}</td>
                    <td>
                        <a href="{{ route('assuntos.show', $assunto) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('assuntos.edit', $assunto) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('assuntos.destroy', $assunto) }}" method="POST" style="display:inline;">
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
