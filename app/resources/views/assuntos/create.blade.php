@extends('layouts.app')

@section('title', 'Adicionar Assunto')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Adicionar Novo Assunto</h1>
    </div>
    <form action="{{ route('assuntos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="Descricao" name="Descricao" required maxlength="20">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
