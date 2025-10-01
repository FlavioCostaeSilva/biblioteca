@extends('layouts.app')

@section('title', 'Detalhes do Assunto')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detalhes do Assunto: {{ $assunto->Descricao }}</h1>
    </div>
    <dl class="row">
        <dt class="col-sm-3">Código</dt>
        <dd class="col-sm-9">{{ $assunto->codAs }}</dd>
        <dt class="col-sm-3">Descrição</dt>
        <dd class="col-sm-9">{{ $assunto->Descricao }}</dd>
    </dl>
    <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
