@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Livro: {{ $livro->Titulo }}</h1>
    </div>
    <form action="{{ route('livros.update', $livro) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="Titulo" name="Titulo" value="{{ $livro->Titulo }}" required maxlength="40">
        </div>
        <div class="mb-3">
            <label for="Editora" class="form-label">Editora</label>
            <input type="text" class="form-control" id="Editora" name="Editora" value="{{ $livro->Editora }}" required maxlength="40">
        </div>
        <div class="mb-3">
            <label for="AnoPublicacao" class="form-label">Ano de Publicação</label>
            <input type="text" class="form-control" id="AnoPublicacao" name="AnoPublicacao" value="{{ $livro->AnoPublicacao }}" required maxlength="4">
        </div>
        <div class="mb-3">
            <label for="Preco" class="form-label">Preço</label>
            <input type="number" class="form-control" id="Preco" name="Preco" value="{{ $livro->Preco }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Autores</label>
            @foreach($autores as $autor)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="autores[]" value="{{ $autor->CodAu }}" id="autor{{ $autor->CodAu }}" {{ $livro->autores->contains($autor->CodAu) ? 'checked' : '' }}>
                    <label class="form-check-label" for="autor{{ $autor->CodAu }}">{{ $autor->Nome }}</label>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label class="form-label">Assuntos</label>
            @foreach($assuntos as $assunto)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="assuntos[]" value="{{ $assunto->codAs }}" id="assunto{{ $assunto->codAs }}" {{ $livro->assuntos->contains($assunto->codAs) ? 'checked' : '' }}>
                    <label class="form-check-label" for="assunto{{ $assunto->codAs }}">{{ $assunto->Descricao }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
