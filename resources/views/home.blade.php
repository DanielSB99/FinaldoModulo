@extends('layout.layout')

@section('title', 'Bem-vindo ao PokéCenter')

@section('content')
<div class="container text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold text-danger mb-4">Bem-vindo ao PokéCenter!</h1>
            <p class="lead text-muted mb-5">
                O teu sistema central para gerir Estúdios e Jogos do universo Pokémon.
                Navega pela nossa base de dados ou faz login para acederes ao teu perfil de Treinador.
            </p>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
               
                <a href="/estudios" class="btn btn-danger btn-lg px-4">Ver Estúdios</a>

                <a href="/jogos" class="btn btn-outline-secondary btn-lg px-4">Ver Jogos</a>

                @guest
                    <a href="/login" class="btn btn-outline-danger btn-lg px-4">Fazer Login</a>
                @endguest

                @auth
                    <a href="/dashboard" class="btn btn-outline-dark btn-lg px-4">Dashboard</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
