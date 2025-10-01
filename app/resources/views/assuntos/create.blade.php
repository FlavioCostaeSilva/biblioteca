@extends('layouts.app')

@section('title', 'Adicionar Assunto')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Adicionar Novo Assunto</h1>
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
    <form action="{{ route('assuntos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control @error('Descricao') is-invalid @enderror" id="Descricao" name="Descricao" required maxlength="20" value="{{ old('Descricao') }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
