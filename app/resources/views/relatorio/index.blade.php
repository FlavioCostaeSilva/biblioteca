@extends('layouts.app')

@section('title', 'Relatório por Autor')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Relatório Agrupado por Autor</h1>
    </div>
    @if($relatorios->isEmpty())
        <p>Nenhum dado disponível no relatório.</p>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Código</th>
                <th>Autor</th>
                <th>Títulos dos Livros</th>
                <th>Editoras</th>
                <th>Assuntos</th>
            </tr>
            </thead>
            <tbody>
            @foreach($relatorios as $relatorio)
                <tr>
                    <td>{{ $relatorio->CodAu }}</td>
                    <td>{{ $relatorio->AutorNome }}</td>
                    <td>{{ $relatorio->TitulosLivros ?? 'Nenhum' }}</td>
                    <td>{{ $relatorio->Editoras ?? 'Nenhum' }}</td>
                    <td>{{ $relatorio->Assuntos ?? 'Nenhum' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
