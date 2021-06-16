<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Automação Residencial</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.6.0-2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <header class="mb-5">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand order-light" href="#">Automação Residencial</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page" href="{{ route('home') }}">Painel de Controle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page"
                            href="{{ route('componentes.index') }}">Componentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page"
                            href="{{ route('informacoes.index') }}">Informações</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; 2018–2021 Dacio Software.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>

</html>
