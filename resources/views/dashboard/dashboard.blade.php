@extends('layout.layout')

@section('title', 'Dashboard - PokéCenter')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card shadow border-0">
                <div class="card-header bg-danger text-white fs-5 fw-bold text-center">
                    Centro de Comando
                </div>
                <div class="card-body p-5 text-center">


                    <h1 class="display-5 text-danger mb-4 fw-bold">Olá, {{ Auth::user()->name }}!</h1>

                    <p class="lead mb-4">
                        Bem-vindo ao teu Dashboard do PokéCenter.

                        {{-- Identificação  do Utilizador --}}
                        @if(Auth::user()->tipo == 1)
                            <br><span class="badge bg-warning text-dark mt-2 fs-6">Nível de Acesso: Professor (Administrador)</span>
                        @else
                            <br><span class="badge bg-primary mt-2 fs-6">Nível de Acesso: Treinador (Utilizador)</span>
                        @endif
                    </p>

                    <hr class="my-4 text-muted">

                    <p class="text-muted mb-4">O que pretendes fazer hoje?</p>

                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a href="/estudios" class="btn btn-outline-danger btn-lg px-4">Explorar Estúdios</a>
                        <a href="/jogos" class="btn btn-outline-danger btn-lg px-4">Explorar Jogos</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
