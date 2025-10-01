@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Autor: {{ $autor->Nome }}</h1>
    </div>
    <form action="{{ route('autores.update', $autor) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="Nome" name="Nome" value="{{ $autor->Nome }}" required maxlength="40">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
