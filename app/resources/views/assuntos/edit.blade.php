@extends('layouts.app')

@section('title', 'Editar Assunto')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Assunto: {{ $assunto->Descricao }}</h1>
    </div>
    <form action="{{ route('assuntos.update', $assunto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="Descricao" name="Descricao" value="{{ $assunto->Descricao }}" required maxlength="20">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
