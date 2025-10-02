<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistema de Biblioteca</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Menu lateral -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <h5 class="sidebar-heading px-3">Menu</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary mb-2" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary mb-2" href="{{ route('livros.index') }}">Gerenciar Livros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary mb-2" href="{{ route('assuntos.index') }}">Gerenciar Assuntos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary mb-2" href="{{ route('autores.index') }}">Gerenciar Autores</a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary mb-2" href="{{ route('relatorio.index') }}">Visualizar Relatório</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Conteúdo principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('content')
        </main>
    </div>
</div>

<script src="/js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="/js/jquery.maskMoney.min.js" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona todos os alerts do Bootstrap presentes na página
        const alerts = document.querySelectorAll('.alert');

        // Para cada alert, define um timeout de 3 segundos para fechá-lo com fade out
        alerts.forEach(function(alertElement) {
            setTimeout(function() {
                // Adiciona transição de opacidade para efeito de esmaecimento
                alertElement.style.transition = 'opacity 0.5s ease-in-out';
                alertElement.style.opacity = 0;

                // Remove o elemento após a transição (500ms)
                setTimeout(function() {
                    alertElement.remove();
                }, 1000);
            }, 4000);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#Preco').maskMoney({
            prefix: 'R$ ',
            allowNegative: false,
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            showSymbol: true,
        });
    });
</script>

</body>
</html>
