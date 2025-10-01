@extends('layouts.app')

@section('title', 'Adicionar Autor')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Adicionar Novo Autor</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('autores.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nome" class="form-label">Nome</label>
            <input type="text" class="form-control @error('Nome') is-invalid @enderror" id="Nome" name="Nome" required maxlength="40" value="{{ old('Nome') }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
