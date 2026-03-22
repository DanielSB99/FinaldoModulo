@extends('layout.layout')
@section('title', 'Lista de Estúdios - PokéCenter')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-danger fw-bold">Estúdios Pokémon</h2>

        @if(Auth::check() && Auth::user()->tipo == 1)
            <a href="/estudios/create" class="btn btn-danger">+ Novo Estúdio</a>
        @endif
    </div>

    {{-- Mensagens de feedback --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Barra de Pesquisa --}}
    <form method="GET" action="/estudios" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="pesquisa"
                   placeholder="Pesquisar estúdio por nome..."
                   value="{{ request('pesquisa') }}">
            <button class="btn btn-danger" type="submit">Pesquisar</button>
            @if(request('pesquisa'))
                <a href="/estudios" class="btn btn-outline-secondary">Limpar</a>
            @endif
        </div>
    </form>

    {{-- Indicador de resultados --}}
    @if(request('pesquisa'))
        <p class="text-muted mb-3">
            A mostrar resultados para: <strong>"{{ request('pesquisa') }}"</strong>
            — {{ count($estudios) }} resultado(s) encontrado(s)
        </p>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">

        @forelse ($estudios as $estudio)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">

                    <div class="bg-light text-center p-3" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                        @if($estudio->logotipo)
                            <img src="{{ asset('storage/' . $estudio->logotipo) }}"
                                 alt="{{ $estudio->nome_do_estudio }}"
                                 class="img-fluid" style="max-height: 100%;">
                        @else
                            <img src="{{ asset('images/default.jpg') }}"
                                 alt="Sem logotipo" class="img-fluid" style="max-height: 100%;">
                        @endif
                    </div>

                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $estudio->nome_do_estudio }}</h5>

                        @if($estudio->ano_fundacao)
                            <p class="text-muted small mb-1">Fundado em {{ $estudio->ano_fundacao }}</p>
                        @endif

                        <p class="text-muted small mb-3">
                            <span class="badge bg-secondary">{{ $estudio->jogos_count }} Jogos Registados</span>
                        </p>

                        <a href="/estudios/{{ $estudio->id }}/jogos" class="btn btn-outline-danger w-100 mb-2">Ver Jogos</a>

                        @if(Auth::check() && Auth::user()->tipo == 1)
                            <a href="/estudios/{{ $estudio->id }}/edit" class="btn btn-outline-primary btn-sm w-100 mb-1">Editar</a>

                            <form action="/estudios/{{ $estudio->id }}" method="POST"
                                  onsubmit="return confirm('Tens a certeza que queres apagar o estúdio \'{{ $estudio->nome_do_estudio }}\'? Todos os jogos associados serão também apagados!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100">Apagar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted mb-0">Nenhum estúdio encontrado.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
