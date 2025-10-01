@extends('layouts.app')

@section('title', 'Detalhes do Autor')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detalhes do Autor: {{ $autor->Nome }}</h1>
    </div>
    <dl class="row">
        <dt class="col-sm-3">Código</dt>
        <dd class="col-sm-9">{{ $autor->CodAu }}</dd>
        <dt class="col-sm-3">Nome</dt>
        <dd class="col-sm-9">{{ $autor->Nome }}</dd>
    </dl>
    <a href="{{ route('autores.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
