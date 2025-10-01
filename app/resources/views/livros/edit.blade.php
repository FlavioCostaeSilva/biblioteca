@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Livro: {{ $livro->Titulo }}</h1>
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
    <form action="{{ route('livros.update', $livro) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Titulo" class="form-label">Título</label>
            <input type="text" class="form-control @error('Titulo') is-invalid @enderror" id="Titulo" name="Titulo" value="{{ old('Titulo', $livro->Titulo) }}" required maxlength="40">
        </div>
        <div class="mb-3">
            <label for="Editora" class="form-label">Editora</label>
            <input type="text" class="form-control @error('Editora') is-invalid @enderror" id="Editora" name="Editora" value="{{ old('Editora', $livro->Editora) }}" required maxlength="40">
        </div>
        <div class="mb-3">
            <label for="AnoPublicacao" class="form-label">Ano de Publicação</label>
            <input type="text" class="form-control @error('AnoPublicacao') is-invalid @enderror" id="AnoPublicacao" name="AnoPublicacao" value="{{ old('AnoPublicacao', $livro->AnoPublicacao) }}" required maxlength="4">
        </div>
        <div class="mb-3">
            <label for="Preco" class="form-label">Preço</label>
            <input type="text" class="form-control @error('Preco') is-invalid @enderror" id="Preco" name="Preco" required value="{{ old('Preco', number_format($livro->Preco / 100, 2, ',', '.')) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Autores</label>
            @foreach($autores as $autor)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="autores[]" value="{{ $autor->CodAu }}" id="autor{{ $autor->CodAu }}" {{ in_array($autor->CodAu, old('autores', $livro->autores->pluck('CodAu')->toArray())) ? 'checked' : '' }}>
                    <label class="form-check-label" for="autor{{ $autor->CodAu }}">{{ $autor->Nome }}</label>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label class="form-label">Assuntos</label>
            @foreach($assuntos as $assunto)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="assuntos[]" value="{{ $assunto->codAs }}" id="assunto{{ $assunto->codAs }}" {{ in_array($assunto->codAs, old('assuntos', $livro->assuntos->pluck('codAs')->toArray())) ? 'checked' : '' }}>
                    <label class="form-check-label" for="assunto{{ $assunto->codAs }}">{{ $assunto->Descricao }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const precoInput = document.getElementById('Preco');

            // Formata o valor inicial se necessário
            precoInput.value = 'R$ ' + precoInput.value;

            function formatMoney(value) {
                value = value.replace(/\D/g, '');
                value = (value / 100).toFixed(2) + '';
                value = value.replace('.', ',');
                value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                return 'R$ ' + value;
            }

            precoInput.addEventListener('input', function(e) {
                let value = e.target.value;
                value = value.replace(/[^\d]/g, '');
                e.target.value = formatMoney(value);
            });

            // Para submissão, converte de volta para decimal (ex: 10,00 -> 10.00)
            const form = precoInput.closest('form');
            form.addEventListener('submit', function() {
                let value = precoInput.value.replace(/R\$ /g, '').replace(/\./g, '').replace(',', '.');
                precoInput.value = parseFloat(value).toFixed(2);
            });
        });
    </script>
@endsection
