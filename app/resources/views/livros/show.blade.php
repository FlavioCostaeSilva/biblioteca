@extends('layouts.app')

@section('title', 'Detalhes do Livro')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detalhes do Livro: {{ $livro->Titulo }}</h1>
    </div>
    <dl class="row">
        <dt class="col-sm-3">Código</dt>
        <dd class="col-sm-9">{{ $livro->Codl }}</dd>
        <dt class="col-sm-3">Título</dt>
        <dd class="col-sm-9">{{ $livro->Titulo }}</dd>
        <dt class="col-sm-3">Editora</dt>
        <dd class="col-sm-9">{{ $livro->Editora }}</dd>
        <dt class="col-sm-3">Ano de Publicação</dt>
        <dd class="col-sm-9">{{ $livro->AnoPublicacao }}</dd>
        <dt class="col-sm-3">Preço</dt>
        <dd class="col-sm-9">R$ {{ number_format($livro->Preco / 100, 2, ',', '.') }}</dd>
        <dt class="col-sm-3">Autores</dt>
        <dd class="col-sm-9">
            @if($livro->autores->isEmpty())
                Nenhum autor associado.
            @else
                <ul>
                    @foreach($livro->autores as $autor)
                        <li>{{ $autor->Nome }}</li>
                    @endforeach
                </ul>
            @endif
        </dd>
        <dt class="col-sm-3">Assuntos</dt>
        <dd class="col-sm-9">
            @if($livro->assuntos->isEmpty())
                Nenhum assunto associado.
            @else
                <ul>
                    @foreach($livro->assuntos as $assunto)
                        <li>{{ $assunto->Descricao }}</li>
                    @endforeach
                </ul>
            @endif
        </dd>
    </dl>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
