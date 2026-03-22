<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pokémon CRM')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">PokéCenter</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/estudios">Estúdios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/jogos">Jogos</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    {{-- guest é para toda gente --}}
                    @guest
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link" href="/login">Entrar</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-outline-light btn-sm ms-2" href="/register">Registar</a>
                        </li>
                    @endguest

                    {{--  @auth mostra isto APENAS a quem TEM login feito --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-white ms-3">
                                Olá, <strong>{{ Auth::user()->name }}</strong>!
                            </span>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-white-50">Sair</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main class="container mt-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
